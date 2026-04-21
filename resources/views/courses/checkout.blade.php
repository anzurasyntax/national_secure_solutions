@extends('layouts.app')

@section('title', 'Checkout: '.$course->title)

@section('content')
    @include('sections.header', ['pageTitle' => 'Checkout'])

    <div class="mx-auto max-w-lg px-6 py-12">
        <h1 class="font-heading text-3xl font-bold text-ink">Checkout</h1>
        <p class="mt-2 text-[#797979]">{{ $course->title }}</p>

        <div class="mt-8 rounded-2xl border border-gray-200 bg-white p-8 shadow-sm">
            @if ($errors->has('checkout'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    {{ $errors->first('checkout') }}
                </div>
            @endif

            <dl class="flex items-baseline justify-between border-b border-gray-100 pb-4">
                <dt class="text-sm text-gray-500">Total</dt>
                <dd class="font-heading text-2xl font-bold text-primary">
                    {{ number_format((float) $course->price, 2) }} {{ $course->currency }}
                </dd>
            </dl>

            <form method="POST" action="{{ route('courses.checkout.store', $course) }}" class="mt-6 space-y-5">
                @csrf

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Full name</label>
                    <input type="text" name="buyer_name" value="{{ old('buyer_name', auth()->user()?->name) }}"
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('buyer_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Email</label>
                    <input type="email" name="buyer_email" required value="{{ old('buyer_email', auth()->user()?->email) }}"
                           @if (auth()->check()) readonly @endif
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 {{ auth()->check() ? 'bg-gray-50' : '' }}">
                    @error('buyer_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500">Receipt and login instructions will be sent here.</p>
                </div>

                <button type="submit"
                        class="w-full rounded-lg bg-primary py-4 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                    Continue to payment
                </button>
            </form>

            <p class="mt-6 text-center text-xs text-gray-500">
                @if (config('courses.payment_driver', 'stripe') === 'stripe')
                    You will complete payment securely on Stripe Checkout (cards, Apple Pay / Google Pay where enabled).
                    Ensure <code class="rounded bg-gray-100 px-1 font-mono text-[11px]">STRIPE_SECRET</code> is set for live or test keys.
                @else
                    Development mode uses a simulated gateway — no card required.
                @endif
            </p>
        </div>
    </div>
@endsection
