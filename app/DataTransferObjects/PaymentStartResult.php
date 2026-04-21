<?php

namespace App\DataTransferObjects;

final class PaymentStartResult
{
    public function __construct(
        public string $redirectUrl,
    ) {}
}
