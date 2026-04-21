<?php

namespace App\Http\Controllers;

use App\Models\CourseOrder;
use App\Services\CoursePurchaseService;
use App\Services\Payment\StripePaymentVerifier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function __construct(
        private readonly CoursePurchaseService $purchaseService,
        private readonly StripePaymentVerifier $verifier,
    ) {}

    public function __invoke(Request $request): Response
    {
        $secret = config('services.stripe.webhook_secret');
        if ($secret === null || $secret === '') {
            Log::warning('Stripe webhook received but STRIPE_WEBHOOK_SECRET is not configured.');

            return response('Webhook secret not configured', 503);
        }

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader ?? '', $secret);
        } catch (SignatureVerificationException|\UnexpectedValueException $e) {
            Log::notice('Invalid Stripe webhook payload.', ['message' => $e->getMessage()]);

            return response('Invalid payload', 400);
        }

        if ($event->type !== 'checkout.session.completed') {
            return response(status: 200);
        }

        $session = $event->data->object;

        $uuid = $session->metadata['course_order_uuid'] ?? null;
        if ($uuid === null || $uuid === '') {
            $uuid = $session->client_reference_id ?? null;
        }

        if ($uuid === null || $uuid === '') {
            Log::warning('Stripe checkout.session.completed missing order reference.', [
                'session_id' => $session->id ?? null,
            ]);

            return response(status: 200);
        }

        $order = CourseOrder::query()->where('uuid', $uuid)->first();
        if ($order === null) {
            Log::warning('Stripe webhook references unknown course order.', [
                'order_uuid' => $uuid,
                'session_id' => $session->id ?? null,
            ]);

            return response(status: 200);
        }

        try {
            $refs = $this->verifier->verifySessionObjectForOrder($session, $order);
        } catch (\RuntimeException $e) {
            Log::error('Stripe webhook session verification failed.', [
                'order_uuid' => $order->uuid,
                'message' => $e->getMessage(),
            ]);

            return response(status: 200);
        }

        $reference = $refs['payment_intent'] ?? $refs['session_id'];

        $order->update([
            'gateway_reference' => $reference,
            'payment_gateway' => 'stripe',
        ]);

        $this->purchaseService->markPaidAndFulfill($order->fresh());

        return response(status: 200);
    }
}
