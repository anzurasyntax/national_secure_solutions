@extends('layouts.admin')

@section('title', 'Home features')

@section('heading', 'Home features')

@section('content')
    <p class="text-sm text-gray-600">There are three cards on the home page. Only the title and description for each can be changed; layout and icons stay the same as the public site.</p>

    <form method="POST" action="{{ route('admin.home-features.update') }}" class="mt-6 space-y-8">
        @csrf
        @method('PUT')

        @for ($i = 1; $i <= 3; $i++)
            @php
                $f = $features->firstWhere('position', $i);
            @endphp
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-4 text-white">
                    <h2 class="font-heading text-sm font-bold uppercase tracking-wide">Card {{ $i }} ({{ str_pad((string) $i, 2, '0', STR_PAD_LEFT) }})</h2>
                </div>
                <div class="space-y-4 px-6 py-6">
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Title</label>
                        <input type="text" name="title_{{ $i }}" value="{{ old("title_{$i}", $f?->title) }}" required
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Description</label>
                        <textarea name="description_{{ $i }}" rows="4" required
                                  class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old("description_{$i}", $f?->description) }}</textarea>
                    </div>
                </div>
            </div>
        @endfor

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="rounded-lg bg-primary px-8 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                Save all
            </button>
            <a href="{{ url('/') }}#features" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-wide text-ink hover:bg-gray-50">
                Preview on site
            </a>
        </div>
    </form>
@endsection
