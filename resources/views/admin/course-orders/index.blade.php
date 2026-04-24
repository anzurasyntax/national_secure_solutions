@extends('layouts.admin')

@section('title', 'Course orders')
@section('heading', 'Course orders')

@section('content')
    <p class="text-sm text-gray-600">Payments created from the public checkout flow (fake gateway or future card processor).</p>

    <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-600">
                <tr>
                    <th class="px-6 py-4">When</th>
                    <th class="px-6 py-4">Course</th>
                    <th class="px-6 py-4">Buyer</th>
                    <th class="px-6 py-4">Amount</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Gateway</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('M j, Y H:i') }}</td>
                        <td class="px-6 py-4 font-semibold text-ink">{{ $order->course?->title ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <div>{{ $order->buyer_email }}</div>
                            @if ($order->user)
                                <div class="text-xs text-gray-500">User #{{ $order->user->id }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ number_format((float) $order->amount, 2) }} {{ $order->currency }}</td>
                        <td class="px-6 py-4">
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-gray-800">{{ $order->status }}</span>
                        </td>
                        <td class="px-6 py-4">{{ $order->payment_gateway }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-gray-600">No orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
@endsection
