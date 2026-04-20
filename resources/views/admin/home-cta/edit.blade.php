@extends('layouts.admin')

@section('title', 'Home CTA')

@section('heading', 'Home CTA')

@section('content')
    <p class="text-sm text-gray-600">Promotional strip above testimonials (headline, supporting text, button). Background uses a hex color plus an image path under <code class="rounded bg-gray-100 px-1">public/</code> (same defaults as before: <code class="rounded bg-gray-100 px-1">#070E20</code> and <code class="rounded bg-gray-100 px-1">img/stat_bg.png</code>).</p>

    <form method="POST" action="{{ route('admin.home-cta.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-4 text-white">
                <h2 class="font-heading text-sm font-bold uppercase tracking-wide">Copy</h2>
            </div>
            <div class="space-y-5 px-6 py-6">
                <div>
                    <label for="headline" class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Headline</label>
                    <textarea id="headline" name="headline" rows="2" required maxlength="500"
                              class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('headline', $homeCta->headline) }}</textarea>
                    @error('headline') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="subheading" class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Supporting line</label>
                    <textarea id="subheading" name="subheading" rows="3" required maxlength="5000"
                              class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('subheading', $homeCta->subheading) }}</textarea>
                    @error('subheading') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="button_label" class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Button label</label>
                        <input type="text" id="button_label" name="button_label" value="{{ old('button_label', $homeCta->button_label) }}" required maxlength="255"
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                        @error('button_label') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="button_url" class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Button URL</label>
                        <input type="text" id="button_url" name="button_url" value="{{ old('button_url', $homeCta->button_url) }}" required maxlength="2048"
                               placeholder="# or https://… or /contact-us"
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                        @error('button_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-4 text-white">
                <h2 class="font-heading text-sm font-bold uppercase tracking-wide">Background</h2>
            </div>
            <div class="grid gap-5 px-6 py-6 sm:grid-cols-2">
                <div>
                    <label for="background_color" class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Background color</label>
                    <input type="text" id="background_color" name="background_color" value="{{ old('background_color', $homeCta->background_color) }}" required maxlength="32"
                           placeholder="#070E20"
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('background_color') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="background_image_path" class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Background image path</label>
                    <input type="text" id="background_image_path" name="background_image_path" value="{{ old('background_image_path', $homeCta->background_image_path) }}" required maxlength="500"
                           placeholder="img/stat_bg.png"
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('background_image_path') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="rounded-lg bg-primary px-8 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                Save CTA
            </button>
            <a href="{{ url('/') }}#cta" target="_blank" rel="noopener" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-wide text-ink hover:bg-gray-50">
                Preview on home
            </a>
        </div>
    </form>
@endsection
