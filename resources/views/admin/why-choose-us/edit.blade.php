@extends('layouts.admin')

@section('title', 'Why Choose Us')

@section('heading', 'Why Choose Us')

@section('content')
    <p class="text-sm text-gray-600">These three cards appear in the home page “Why Choose Us” strip. Uploading a new icon saves under <code class="rounded bg-gray-100 px-1 text-xs">public/img/why-choose/</code>; leave empty to keep the current file.</p>

    <form method="POST" action="{{ route('admin.why-choose-us.update') }}" enctype="multipart/form-data" class="mt-6 space-y-8">
        @csrf
        @method('PUT')

        @for ($i = 1; $i <= 3; $i++)
            @php $item = $items->firstWhere('position', $i); @endphp
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-4 text-white">
                    <h2 class="font-heading text-sm font-bold uppercase tracking-wide">Card {{ $i }}</h2>
                </div>
                <div class="space-y-4 px-6 py-6">
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Title</label>
                        <input type="text" name="title_{{ $i }}" value="{{ old('title_'.$i, $item?->title) }}" required
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Description</label>
                        <textarea name="description_{{ $i }}" rows="4" required
                                  class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('description_'.$i, $item?->description) }}</textarea>
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Icon image {{ $item ? '(replace)' : '' }}</label>
                        <input type="file" name="icon_{{ $i }}" accept="image/*"
                               class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-ink file:px-4 file:py-2 file:font-heading file:text-xs file:font-bold file:uppercase file:text-white hover:file:bg-[#111a35]">
                        @if ($item?->icon_path)
                            <p class="mt-2 text-xs text-gray-500">Current: <code class="rounded bg-gray-100 px-1">{{ $item->icon_path }}</code></p>
                        @endif
                    </div>
                </div>
            </div>
        @endfor

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="rounded-lg bg-primary px-8 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                Save section
            </button>
            <a href="{{ url('/') }}#why-choose-us" target="_blank" rel="noopener" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-wide text-ink hover:bg-gray-50">
                Preview on home
            </a>
        </div>
    </form>
@endsection
