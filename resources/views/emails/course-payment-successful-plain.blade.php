Payment successful

Thank you — your payment for "{{ $order->course?->title ?? 'your course' }}" has been confirmed.

Amount: {{ number_format((float) $order->amount, 2) }} {{ strtoupper($order->currency) }}
@if ($order->paid_at)
Date: {{ $order->paid_at->timezone(config('app.timezone'))->format('M j, Y g:i A') }}
@endif

@if ($order->user_id !== null)
Continue to My learning: {{ url(route('student.dashboard', [], false)) }}
@else
Create your student login using the page shown after checkout to access your modules.
@endif

— {{ config('app.name') }}
