<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Payment driver
    |--------------------------------------------------------------------------
    |
    | "stripe" — Stripe Checkout (card wallets, etc.). Set STRIPE_SECRET and
    | STRIPE_WEBHOOK_SECRET in .env. Register the webhook endpoint in Stripe:
    | POST {APP_URL}/stripe/webhook — event checkout.session.completed.
    |
    | "fake" — signed redirect only, for local testing without Stripe.
    | Not allowed when APP_ENV=production (application will refuse to boot binding).
    |
    */
    'payment_driver' => env('COURSE_PAYMENT_DRIVER', 'stripe'),

];
