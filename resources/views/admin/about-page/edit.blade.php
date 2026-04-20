@extends('layouts.admin')

@section('title', 'About page')

@section('heading', 'About page')

@section('content')
    <p class="text-sm text-gray-600">Edit the About page copy. Rich text fields use the editor below; use the statement list box for one bullet line per row. Upload a new hero photo below (stored under <code class="rounded bg-gray-100 px-1 text-xs">public/img/about/</code>).</p>

    <form method="POST" action="{{ route('admin.about-page.update') }}" enctype="multipart/form-data" class="mt-6 space-y-8">
        @csrf
        @method('PUT')

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-4 text-white">
                <h2 class="font-heading text-sm font-bold uppercase tracking-wide">Hero image</h2>
            </div>
            <div class="space-y-4 px-6 py-5">
                @if ($about->hero_image_path)
                    <div class="flex flex-wrap items-start gap-4">
                        <div class="overflow-hidden rounded-lg border border-gray-200 bg-gray-100">
                            <img src="{{ asset($about->hero_image_path) }}" alt="Current hero image" class="max-h-48 max-w-full object-cover">
                        </div>
                        <p class="text-xs text-gray-500">Current file: <code class="rounded bg-gray-100 px-1">{{ $about->hero_image_path }}</code></p>
                    </div>
                @endif
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">{{ $about->hero_image_path ? 'Replace image' : 'Upload image' }}</label>
                    <input type="file" name="hero_image" accept="image/*"
                           class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-ink file:px-4 file:py-2 file:font-heading file:text-xs file:font-bold file:uppercase file:tracking-wide file:text-white hover:file:bg-[#111a35]">
                    <p class="mt-2 text-xs text-gray-500">JPG, PNG, or WebP. Max 5&nbsp;MB. Leave empty to keep the current image.</p>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-4 text-white">
                <h2 class="font-heading text-sm font-bold uppercase tracking-wide">Top section (image + brand)</h2>
            </div>
            <div class="space-y-4 px-6 py-6">
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Brand title</label>
                    <input type="text" name="brand_title" value="{{ old('brand_title', $about->brand_title) }}" required
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Intro</label>
                    <textarea name="brand_intro" class="js-wysiwyg min-h-[200px] w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">{{ old('brand_intro', $about->brand_intro) }}</textarea>
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Mission title</label>
                        <input type="text" name="mission_title" value="{{ old('mission_title', $about->mission_title) }}" required
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Vision title</label>
                        <input type="text" name="vision_title" value="{{ old('vision_title', $about->vision_title) }}" required
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Mission body</label>
                    <textarea name="mission_body" class="js-wysiwyg min-h-[160px] w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">{{ old('mission_body', $about->mission_body) }}</textarea>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Vision body</label>
                    <textarea name="vision_body" class="js-wysiwyg min-h-[120px] w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">{{ old('vision_body', $about->vision_body) }}</textarea>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-4 text-white">
                <h2 class="font-heading text-sm font-bold uppercase tracking-wide">Memberships &amp; leadership</h2>
            </div>
            <div class="space-y-4 px-6 py-6">
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Memberships heading</label>
                    <input type="text" name="memberships_heading" value="{{ old('memberships_heading', $about->memberships_heading) }}" required
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Memberships body</label>
                    <textarea name="memberships_body" class="js-wysiwyg min-h-[140px] w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">{{ old('memberships_body', $about->memberships_body) }}</textarea>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Leadership heading</label>
                    <input type="text" name="leadership_heading" value="{{ old('leadership_heading', $about->leadership_heading) }}" required
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Leadership body</label>
                    <textarea name="leadership_body" class="js-wysiwyg min-h-[140px] w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">{{ old('leadership_body', $about->leadership_body) }}</textarea>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-4 text-white">
                <h2 class="font-heading text-sm font-bold uppercase tracking-wide">Bold statement</h2>
            </div>
            <div class="space-y-4 px-6 py-6">
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Statement heading</label>
                    <textarea name="statement_heading" class="js-wysiwyg min-h-[120px] w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">{{ old('statement_heading', $about->statement_heading) }}</textarea>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">List (one line per bullet)</label>
                    <textarea name="statement_list" rows="10" required
                              class="w-full rounded-lg border border-gray-300 px-4 py-3 font-mono text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('statement_list', $about->statement_list) }}</textarea>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Statement footer paragraph</label>
                    <textarea name="statement_footer" class="js-wysiwyg min-h-[120px] w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">{{ old('statement_footer', $about->statement_footer) }}</textarea>
                </div>
            </div>
        </div>

        @foreach (['founder' => 'Founder', 'chairman' => 'Chairman of The Board', 'president' => 'President'] as $key => $label)
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-4 text-white">
                    <h2 class="font-heading text-sm font-bold uppercase tracking-wide">{{ $label }}</h2>
                </div>
                <div class="space-y-4 px-6 py-6">
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Section heading</label>
                            <input type="text" name="{{ $key }}_heading" value="{{ old($key.'_heading', $about->{$key.'_heading'}) }}" required
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                        </div>
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Name / subtitle</label>
                            <input type="text" name="{{ $key }}_subtitle" value="{{ old($key.'_subtitle', $about->{$key.'_subtitle'}) }}" required
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                        </div>
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Bio</label>
                        <textarea name="{{ $key }}_body" class="js-wysiwyg min-h-[220px] w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">{{ old($key.'_body', $about->{$key.'_body'}) }}</textarea>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="rounded-lg bg-primary px-8 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                Save about page
            </button>
            <a href="{{ route('about') }}" target="_blank" rel="noopener" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-wide text-ink hover:bg-gray-50">
                Preview about page
            </a>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof tinymce === 'undefined') return;
            tinymce.init({
                selector: 'textarea.js-wysiwyg',
                height: 260,
                menubar: false,
                plugins: 'lists link autoresize autolink',
                toolbar: 'undo redo | bold italic underline | bullist numlist | link removeformat',
                branding: false,
                convert_urls: false,
                content_style: 'body { font-family: ui-sans-serif, system-ui, sans-serif; font-size: 14px; }'
            });

            var form = document.querySelector('form[action*="about-page"]');
            if (form) {
                form.addEventListener('submit', function () {
                    if (typeof tinymce !== 'undefined') {
                        tinymce.triggerSave();
                    }
                });
            }
        });
    </script>
@endpush
