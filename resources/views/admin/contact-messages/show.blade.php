@extends('layouts.admin')

@section('title', 'Contact message')
@section('heading', 'Contact message')

@section('content')
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-100 px-6 py-5">
            <p class="text-sm text-gray-500">Received {{ $message->created_at->format('M j, Y \a\t g:i A') }}</p>
            <h2 class="mt-1 font-heading text-xl font-bold text-ink">{{ $message->name }}</h2>
        </div>
        <dl class="divide-y divide-gray-100 px-6">
            <div class="grid gap-1 py-4 sm:grid-cols-3">
                <dt class="text-xs font-bold uppercase tracking-wide text-gray-500">Email</dt>
                <dd class="sm:col-span-2"><a href="mailto:{{ $message->email }}" class="text-primary hover:underline">{{ $message->email }}</a></dd>
            </div>
            <div class="grid gap-1 py-4 sm:grid-cols-3">
                <dt class="text-xs font-bold uppercase tracking-wide text-gray-500">Phone</dt>
                <dd class="sm:col-span-2">{{ $message->phone ?: '—' }}</dd>
            </div>
            <div class="grid gap-1 py-4 sm:grid-cols-3">
                <dt class="text-xs font-bold uppercase tracking-wide text-gray-500">Message</dt>
                <dd class="sm:col-span-2 whitespace-pre-wrap text-gray-800">{{ $message->message }}</dd>
            </div>
        </dl>
        <div class="flex flex-wrap gap-3 border-t border-gray-100 px-6 py-5">
            <a href="{{ route('admin.contact-messages.index') }}" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-wide text-ink hover:bg-gray-50">
                Back to list
            </a>
            <form method="POST" action="{{ route('admin.contact-messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-lg bg-red-600 px-6 py-3 font-heading text-xs font-bold uppercase tracking-wide text-white hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endsection
