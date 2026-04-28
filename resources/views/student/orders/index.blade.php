@extends('layouts.student-app')

@section('title', 'Order History')

@section('student_content')
    <h1 class="font-heading text-3xl font-bold text-ink">Order History</h1>

    <div class="mt-8 flex flex-wrap gap-2">
        <span class="rounded-lg border border-primary px-4 py-2 text-sm font-semibold text-primary">Today</span>
        <span class="rounded-lg border border-primary px-4 py-2 text-sm font-semibold text-primary">Monthly</span>
        <span class="rounded-lg border border-primary px-4 py-2 text-sm font-semibold text-primary">Yearly</span>
    </div>

    <div class="mt-10 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wide text-slate-600">
                    <tr>
                        <th class="px-6 py-4">Order ID</th>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-slate-50/80">
                            <td class="px-6 py-4 font-mono text-xs text-slate-800">#{{ $order->id }}</td>
                            <td class="px-6 py-4 font-medium text-ink">{{ $order->course?->title ?? 'Course' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $order->created_at->format('j F Y') }}</td>
                            <td class="px-6 py-4">{{ $order->currency }} {{ number_format((float) $order->amount, 2) }}</td>
                            <td class="px-6 py-4">
                                @if ($order->status === $statusPaid)
                                    <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">Completed</span>
                                @else
                                    <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-900">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-primary/10 text-primary" title="Receipt">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-600">No orders yet. <a href="{{ route('courses.index') }}" class="font-semibold text-primary hover:underline">Browse courses</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
