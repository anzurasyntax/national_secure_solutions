@extends('layouts.admin')

@section('title', 'Home stats')

@section('heading', 'Home stats')

@section('content')
    <p class="text-sm text-gray-600">These four counters appear on the home page stats strip. Set the label, numeric value, and optional suffix (e.g. <code class="rounded bg-gray-100 px-1">+</code>) shown after the number.</p>

    <form method="POST" action="{{ route('admin.home-stats.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        @for ($i = 1; $i <= 4; $i++)
            @php $s = $stats->firstWhere('position', $i); @endphp
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-4 text-white">
                    <h2 class="font-heading text-sm font-bold uppercase tracking-wide">Stat {{ $i }}</h2>
                </div>
                <div class="grid gap-4 px-6 py-6 sm:grid-cols-3">
                    <div class="sm:col-span-1">
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Heading</label>
                        <input type="text" name="heading_{{ $i }}" value="{{ old('heading_'.$i, $s?->heading) }}" required
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Value</label>
                        <input type="number" name="value_{{ $i }}" value="{{ old('value_'.$i, $s?->value ?? 0) }}" required min="0"
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Suffix after number</label>
                        <input type="text" name="suffix_{{ $i }}" value="{{ old('suffix_'.$i, $s?->suffix) }}" maxlength="10"
                               placeholder="+ or leave empty"
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                </div>
            </div>
        @endfor

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="rounded-lg bg-primary px-8 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                Save stats
            </button>
            <a href="{{ url('/') }}#stats" target="_blank" rel="noopener" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-wide text-ink hover:bg-gray-50">
                Preview on home
            </a>
        </div>
    </form>
@endsection
