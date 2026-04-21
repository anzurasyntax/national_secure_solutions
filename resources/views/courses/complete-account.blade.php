@extends('layouts.app')

@section('title', 'Create student login')

@section('content')
    @include('sections.header', ['pageTitle' => 'Create login'])

    <div class="mx-auto max-w-lg px-6 py-12">
        @if (session('status'))
            <div class="mb-8 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-900">
                {{ session('status') }}
            </div>
        @endif

        <h1 class="font-heading text-3xl font-bold text-ink">Create your student login</h1>
        <p class="mt-2 text-[#797979]">
            Payment received for <span class="font-semibold text-ink">{{ $order->course?->title }}</span>.
            Choose a password to access your modules.
        </p>

        <form method="POST" action="{{ route('courses.account.complete.store') }}" class="mt-8 space-y-5 rounded-2xl border border-gray-200 bg-white p-8 shadow-sm">
            @csrf

            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Email</label>
                <input type="email" value="{{ $prefillEmail }}" disabled
                       class="w-full cursor-not-allowed rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-600">
            </div>

            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Display name</label>
                <input type="text" name="name" required value="{{ old('name', $order->buyer_name) }}"
                       class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Password</label>
                <input type="password" name="password" required autocomplete="new-password"
                       class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Confirm password</label>
                <input type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
            </div>

            <button type="submit"
                    class="w-full rounded-lg bg-navy py-4 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white transition hover:bg-[#151a66]">
                Save &amp; continue
            </button>
        </form>
    </div>
@endsection
