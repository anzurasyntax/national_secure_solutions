<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment confirmed</title>
</head>
<body style="font-family: system-ui, sans-serif; line-height: 1.5; color: #111; max-width: 560px; margin: 0 auto; padding: 24px;">
    <h1 style="font-size: 1.25rem;">Payment successful</h1>
    <p>Thank you — your payment for <strong>{{ $order->course?->title ?? 'your course' }}</strong> has been confirmed.</p>
    <p>
        <strong>Amount:</strong> {{ number_format((float) $order->amount, 2) }} {{ strtoupper($order->currency) }}<br>
        @if ($order->paid_at)
            <strong>Date:</strong> {{ $order->paid_at->timezone(config('app.timezone'))->format('M j, Y g:i A') }}
        @endif
    </p>
    @if ($order->user_id !== null)
        <p>You can continue to <a href="{{ url(route('student.dashboard', [], false)) }}">My learning</a> anytime to open your course.</p>
    @else
        <p>Create your student login using the link from checkout to access your modules. If you already started, finish setting your password on the account page you were shown after payment.</p>
    @endif
    <p style="margin-top: 32px; font-size: 0.875rem; color: #666;">{{ config('app.name') }}</p>
</body>
</html>
