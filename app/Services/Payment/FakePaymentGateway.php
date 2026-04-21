<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayContract;
use App\DataTransferObjects\PaymentStartResult;
use App\Models\CourseOrder;
use Illuminate\Support\Facades\URL;

class FakePaymentGateway implements PaymentGatewayContract
{
    public function beginCheckout(CourseOrder $order): PaymentStartResult
    {
        $url = URL::temporarySignedRoute(
            'courses.payment.return',
            now()->addMinutes(30),
            ['order' => $order->uuid]
        );

        return new PaymentStartResult($url);
    }
}
