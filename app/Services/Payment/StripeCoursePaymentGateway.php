<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayContract;
use App\DataTransferObjects\PaymentStartResult;
use App\Models\CourseOrder;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class StripeCoursePaymentGateway implements PaymentGatewayContract
{
    public function beginCheckout(CourseOrder $order): PaymentStartResult
    {
        $secret = config('services.stripe.secret');
        if ($secret === null || $secret === '') {
            throw new \RuntimeException(
                'Stripe is not configured. Add STRIPE_SECRET to your .env file (see .env.example).'
            );
        }

        Stripe::setApiKey($secret);

        $course = $order->course;
        if ($course === null) {
            throw new \RuntimeException('Course order is missing a course.');
        }

        $currency = strtolower((string) $order->currency);
        $unitAmount = (int) round(((float) $order->amount) * 100);

        try {
            $session = Session::create([
                'mode' => 'payment',
                'customer_email' => $order->buyer_email,
                'client_reference_id' => $order->uuid,
                'metadata' => [
                    'course_order_uuid' => $order->uuid,
                    'course_id' => (string) $order->course_id,
                ],
                'line_items' => [
                    [
                        'quantity' => 1,
                        'price_data' => [
                            'currency' => $currency,
                            'unit_amount' => $unitAmount,
                            'product_data' => [
                                'name' => $course->title,
                                'description' => Str::limit(strip_tags((string) ($course->summary ?? '')), 450),
                            ],
                        ],
                    ],
                ],
                'success_url' => route('courses.payment.stripe.success', ['order' => $order->uuid]).'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('courses.checkout', $course),
            ]);
        } catch (ApiErrorException $e) {
            throw new \RuntimeException('Unable to start Stripe Checkout: '.$e->getMessage(), 0, $e);
        }

        if ($session->url === null || $session->url === '') {
            throw new \RuntimeException('Stripe did not return a checkout URL.');
        }

        return new PaymentStartResult($session->url);
    }
}
