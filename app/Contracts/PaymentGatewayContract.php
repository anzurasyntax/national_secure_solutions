<?php

namespace App\Contracts;

use App\DataTransferObjects\PaymentStartResult;
use App\Models\CourseOrder;

interface PaymentGatewayContract
{
    /**
     * Redirect the customer through the gateway (or directly back for fake/testing).
     */
    public function beginCheckout(CourseOrder $order): PaymentStartResult;
}
