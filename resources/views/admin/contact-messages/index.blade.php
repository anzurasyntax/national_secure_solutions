@extends('layouts.admin')

@section('title', 'Contact messages')
@section('heading', 'Contact messages')

@section('content')
    <p class="text-sm text-gray-600">Messages submitted from the public contact form.</p>

    <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-600">
                    <tr>
                        <th class="px-6 py-4">When</th>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Phone</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($messages as $message)
                        <tr class="{{ $message->read_at ? '' : 'bg-red-50/40' }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $message->created_at->format('M j, Y H:i') }}</td>
                            <td class="px-6 py-4 font-semibold text-ink">{{ $message->name }}</td>
                            <td class="px-6 py-4">{{ $message->email }}</td>
                            <td class="px-6 py-4">{{ $message->phone ?: '—' }}</td>
                            <td class="px-6 py-4">
                                @if ($message->read_at)
                                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-gray-700">Read</span>
                                @else
                                    <span class="rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-primary">New</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.contact-messages.show', $message) }}" class="font-semibold text-primary hover:underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-gray-600">No messages yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
@endsection
