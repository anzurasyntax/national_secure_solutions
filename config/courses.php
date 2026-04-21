<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Payment driver
    |--------------------------------------------------------------------------
    |
    | "stripe" — Stripe Checkout (card wallets, etc.). Set STRIPE_SECRET in .env.
    | "fake" — signed redirect only, for local testing without Stripe.
    |
    */
    'payment_driver' => env('COURSE_PAYMENT_DRIVER', 'stripe'),

];
