<?php

namespace App\Services;

use App\Contracts\PaymentGatewayContract;
use App\DataTransferObjects\PaymentStartResult;
use App\Enums\CourseOrderStatus;
use App\Mail\CoursePaymentSuccessfulMail;
use App\Models\Course;
use App\Models\CourseOrder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CoursePurchaseService
{
    public function __construct(
        private readonly PaymentGatewayContract $paymentGateway,
        private readonly EnrollmentService $enrollmentService,
    ) {}

    /**
     * Creates a pending order and returns where to send the browser next.
     */
    public function createPendingOrder(Course $course, string $buyerEmail, ?string $buyerName, ?User $existingUser): CourseOrder
    {
        return CourseOrder::query()->create([
            'course_id' => $course->id,
            'user_id' => $existingUser?->id,
            'buyer_email' => strtolower(trim($buyerEmail)),
            'buyer_name' => $buyerName !== null && $buyerName !== '' ? trim($buyerName) : null,
            'amount' => $course->price,
            'currency' => $course->currency,
            'status' => CourseOrderStatus::Pending->value,
            'payment_gateway' => config('courses.payment_driver', 'stripe'),
            'meta' => ['created_via' => 'checkout'],
        ]);
    }

    public function beginGatewayCheckout(CourseOrder $order): PaymentStartResult
    {
        return $this->paymentGateway->beginCheckout($order);
    }

    /**
     * Marks order paid; enrolls existing user or leaves enrollment for account setup.
     */
    public function markPaidAndFulfill(CourseOrder $order): void
    {
        $becamePaid = false;

        DB::transaction(function () use ($order, &$becamePaid): void {
            if ($order->status !== CourseOrderStatus::Paid->value) {
                $becamePaid = true;
                $order->update([
                    'status' => CourseOrderStatus::Paid->value,
                    'paid_at' => now(),
                    'gateway_reference' => $order->gateway_reference ?? 'fake-'.uniqid('', true),
                ]);
            }

            $order->refresh();

            $user = $order->user;
            $course = $order->course;
            if ($user !== null && $course !== null) {
                $this->enrollmentService->enroll($user, $course, $order);
            }
        });

        if ($becamePaid) {
            $this->sendPaymentConfirmationIfPossible($order->fresh());
        }
    }

    private function sendPaymentConfirmationIfPossible(CourseOrder $order): void
    {
        $email = strtolower(trim((string) $order->buyer_email));
        if ($email === '') {
            Log::warning('Course order paid but buyer_email empty; skipping confirmation email.', [
                'order_uuid' => $order->uuid,
            ]);

            return;
        }

        $order->loadMissing('course');

        $mailable = new CoursePaymentSuccessfulMail($order);
        $subject = $mailable->envelope()->subject ?? 'Payment confirmed';
        $plainBody = view('emails.course-payment-successful-plain', ['order' => $order])->render();

        Log::info('Course payment confirmation email', [
            'to' => $email,
            'subject' => $subject,
            'mailer' => config('mail.default'),
            'body_plain' => trim($plainBody),
        ]);

        try {
            Mail::to($email)->send($mailable);
        } catch (\Throwable $e) {
            Log::error('Failed to send course payment confirmation email', [
                'to' => $email,
                'order_uuid' => $order->uuid,
                'exception' => $e->getMessage(),
            ]);
        }
    }

    /**
     * After payment: create student account or attach order to existing user by email.
     *
     * @return array{user: User, created: bool}
     */
    public function registerStudentFromPaidOrder(CourseOrder $order, string $name, string $password): array
    {
        return DB::transaction(function () use ($order, $name, $password): array {
            $email = strtolower(trim($order->buyer_email));

            $existing = User::query()->where('email', $email)->first();
            if ($existing !== null) {
                $order->update(['user_id' => $existing->id]);
                if ($existing->name === '' || $existing->name === null) {
                    $existing->update(['name' => trim($name)]);
                }
                $this->enrollmentService->enroll($existing, $order->course, $order);

                return ['user' => $existing, 'created' => false];
            }

            $user = User::query()->create([
                'name' => trim($name),
                'email' => $email,
                'password' => Hash::make($password),
                'is_admin' => false,
            ]);

            $order->update(['user_id' => $user->id]);
            $this->enrollmentService->enroll($user, $order->course, $order);

            return ['user' => $user, 'created' => true];
        });
    }

    /**
     * Links paid orders by email to the user account (e.g. after login).
     */
    public function attachPaidOrdersForUser(User $user): void
    {
        $email = strtolower(trim($user->email));

        CourseOrder::query()
            ->where('buyer_email', $email)
            ->where('status', CourseOrderStatus::Paid->value)
            ->update(['user_id' => $user->id]);

        $orders = CourseOrder::query()
            ->where('user_id', $user->id)
            ->where('status', CourseOrderStatus::Paid->value)
            ->with('course')
            ->get();

        foreach ($orders as $order) {
            if ($order->course !== null) {
                $this->enrollmentService->enroll($user, $order->course, $order);
            }
        }
    }
}
