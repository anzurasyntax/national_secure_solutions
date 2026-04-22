@extends('layouts.admin')

@section('title', 'Dashboard')

@section('heading', 'Dashboard')

@section('content')
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <p class="font-heading text-xs font-bold uppercase tracking-[0.2em] text-gray-400">Overview</p>
            <p class="mt-2 font-heading text-2xl font-bold text-ink">Welcome</p>
            <p class="mt-2 text-sm text-gray-600">You are signed in as <span class="font-semibold text-ink">{{ Auth::user()?->name }}</span>.</p>
        </div>
        <div class="rounded-2xl border border-dashed border-primary/30 bg-white p-6 shadow-sm">
            <p class="font-heading text-xs font-bold uppercase tracking-[0.2em] text-gray-400">Quick link</p>
            <p class="mt-2 text-sm text-gray-600">Public site uses the same brand colors and typography as this panel.</p>
            <a href="{{ url('/') }}" class="mt-4 inline-flex items-center font-heading text-sm font-bold uppercase tracking-wide text-primary hover:underline">
                Open homepage →
            </a>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-gradient-to-br from-ink to-[#111a35] p-6 text-white shadow-sm sm:col-span-2 lg:col-span-1">
            <p class="font-heading text-xs font-bold uppercase tracking-[0.2em] text-white/60">Panel</p>
            <p class="mt-2 font-heading text-lg font-bold">National Secure Solutions</p>
            <p class="mt-2 text-sm text-white/75">Extend this area with CMS sections, inquiries, or user management when you are ready.</p>
        </div>
    </div>
@endsection
