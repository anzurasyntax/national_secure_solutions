<?php

namespace App\Services\Payment;

use App\Models\CourseOrder;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class StripePaymentVerifier
{
    /**
     * Confirms the Checkout Session matches the order and payment succeeded.
     *
     * @return array{session_id: string, payment_intent: ?string}
     *
     * @throws \RuntimeException
     */
    public function verifyCheckoutSession(string $checkoutSessionId, CourseOrder $order): array
    {
        $secret = config('services.stripe.secret');
        if ($secret === null || $secret === '') {
            throw new \RuntimeException('Stripe is not configured.');
        }

        Stripe::setApiKey($secret);

        try {
            $session = Session::retrieve($checkoutSessionId);
        } catch (ApiErrorException $e) {
            throw new \RuntimeException('Could not verify payment with Stripe: '.$e->getMessage(), 0, $e);
        }

        $metaUuid = $session->metadata['course_order_uuid'] ?? null;
        if ($metaUuid !== $order->uuid) {
            throw new \RuntimeException('Payment session does not match this order.');
        }

        if (($session->payment_status ?? '') !== 'paid') {
            throw new \RuntimeException('Payment has not completed yet.');
        }

        $expectedTotal = (int) round(((float) $order->amount) * 100);
        if ((int) ($session->amount_total ?? 0) !== $expectedTotal) {
            throw new \RuntimeException('Paid amount does not match the order total.');
        }

        $currency = strtolower((string) $order->currency);
        if (($session->currency ?? '') !== $currency) {
            throw new \RuntimeException('Paid currency does not match the order.');
        }

        $paymentIntent = $session->payment_intent ?? null;
        if (is_object($paymentIntent) && isset($paymentIntent->id)) {
            $paymentIntent = $paymentIntent->id;
        }

        return [
            'session_id' => $session->id,
            'payment_intent' => is_string($paymentIntent) ? $paymentIntent : null,
        ];
    }
}
