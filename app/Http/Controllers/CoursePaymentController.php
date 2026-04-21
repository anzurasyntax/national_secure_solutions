<?php

namespace App\Http\Controllers;

use App\Enums\CourseOrderStatus;
use App\Http\Requests\Course\CompleteCourseAccountRequest;
use App\Models\CourseOrder;
use App\Services\CoursePurchaseService;
use App\Services\Payment\StripePaymentVerifier;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursePaymentController extends Controller
{
    public function __construct(
        private readonly CoursePurchaseService $purchaseService,
    ) {}

    /**
     * Signed return URL used only by the fake payment gateway (local/test checkout).
     * Real Stripe payments must complete via stripeSuccess(); this route must never fulfill Stripe orders.
     */
    public function paymentReturn(CourseOrder $order): RedirectResponse
    {
        if (($order->payment_gateway ?? '') !== 'fake') {
            abort(403, 'This completion URL is only valid for the test payment flow.');
        }

        $allowed = [
            CourseOrderStatus::Pending->value,
            CourseOrderStatus::Paid->value,
        ];
        if (! in_array($order->status, $allowed, true)) {
            abort(403);
        }

        if ($order->status !== CourseOrderStatus::Paid->value) {
            $this->purchaseService->markPaidAndFulfill($order->fresh());
        }

        return $this->redirectAfterPaid($order->fresh());
    }

    /**
     * Stripe Checkout success redirect. Unauthenticated; {@see StripePaymentVerifier} binds session_id to the order.
     * Idempotent once the order is paid (safe if the customer refreshes or replays the URL).
     */
    public function stripeSuccess(Request $request, StripePaymentVerifier $verifier, CourseOrder $order): RedirectResponse
    {
        $allowed = [
            CourseOrderStatus::Pending->value,
            CourseOrderStatus::Paid->value,
        ];
        if (! in_array($order->status, $allowed, true)) {
            abort(403);
        }

        if ($order->isPaid()) {
            return $this->redirectAfterPaid($order);
        }

        $validated = $request->validate([
            'session_id' => ['required', 'string', 'max:255'],
        ]);

        try {
            $refs = $verifier->verifyCheckoutSession($validated['session_id'], $order);
        } catch (\RuntimeException $e) {
            return redirect()
                ->route('courses.checkout', $order->course)
                ->withErrors(['checkout' => $e->getMessage()]);
        }

        $reference = $refs['payment_intent'] ?? $refs['session_id'];

        $order->update([
            'gateway_reference' => $reference,
            'payment_gateway' => 'stripe',
        ]);

        $this->purchaseService->markPaidAndFulfill($order->fresh());

        return $this->redirectAfterPaid($order->fresh());
    }

    private function redirectAfterPaid(CourseOrder $order): RedirectResponse
    {
        if ($order->user_id !== null) {
            return redirect()
                ->route('student.dashboard')
                ->with('status', 'Payment successful. Your course is now available.');
        }

        session([
            'complete_account_order_uuid' => $order->uuid,
        ]);

        return redirect()
            ->route('courses.account.complete')
            ->with('status', 'Payment successful! Create your student login below to access your course.');
    }

    public function completeAccountForm(): View|RedirectResponse
    {
        $uuid = session('complete_account_order_uuid');
        if ($uuid === null || $uuid === '') {
            return redirect()
                ->route('courses.index')
                ->withErrors(['email' => 'Session expired. Please contact support if you completed payment.']);
        }

        $order = CourseOrder::query()->where('uuid', $uuid)->firstOrFail();

        if (! $order->isPaid()) {
            abort(403);
        }

        if ($order->user_id !== null) {
            return redirect()->route('login')->with('status', 'Your order is already linked to an account. Please log in.');
        }

        return view('courses.complete-account', [
            'order' => $order,
            'prefillEmail' => $order->buyer_email,
        ]);
    }

    public function completeAccount(CompleteCourseAccountRequest $request): RedirectResponse
    {
        $uuid = session('complete_account_order_uuid');
        if ($uuid === null || $uuid === '') {
            return redirect()->route('courses.index')->withErrors(['email' => 'Session expired.']);
        }

        $order = CourseOrder::query()->where('uuid', $uuid)->firstOrFail();

        if (! $order->isPaid() || $order->user_id !== null) {
            abort(403);
        }

        $result = $this->purchaseService->registerStudentFromPaidOrder(
            $order,
            $request->validated('name'),
            $request->validated('password')
        );

        session()->forget('complete_account_order_uuid');

        Auth::login($result['user']);
        $request->session()->regenerate();

        $message = $result['created']
            ? 'Welcome! Your account is ready and your course is unlocked.'
            : 'Your purchase is linked to your existing account. You are now logged in.';

        return redirect()->route('student.dashboard')->with('status', $message);
    }
}
