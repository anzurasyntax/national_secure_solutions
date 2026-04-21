@extends('layouts.admin')

@section('title', 'CMS')
@section('heading', 'CMS')

@section('content')
    <div class="space-y-8">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-6 text-white">
                <h2 class="font-heading text-lg font-bold uppercase tracking-wide">Brand</h2>
                <p class="mt-1 text-sm text-white/70">Logo appears in the public site header, footer, and login screens. Recommended: PNG or SVG with transparent background.</p>
            </div>

            <form method="POST" action="{{ route('admin.site-settings.update') }}" enctype="multipart/form-data" class="space-y-6 px-6 py-8">
                @csrf
                @method('PUT')

                <div class="rounded-xl border border-gray-100 bg-[#fafbfc] p-6">
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Site logo</label>
                    @if ($setting->logo_path)
                        <div class="mb-4 flex flex-wrap items-center gap-4">
                            <img src="{{ $setting->logoUrl() }}" alt="Current logo" class="max-h-20 w-auto rounded border border-gray-200 bg-white object-contain p-2">
                            <label class="flex items-center gap-2 text-sm text-gray-700">
                                <input type="checkbox" name="remove_logo" value="1" class="rounded border-gray-300 text-primary focus:ring-primary">
                                Remove custom logo (revert to default)
                            </label>
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/*"
                           class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-ink file:px-4 file:py-2 file:font-heading file:text-xs file:font-bold file:uppercase file:text-white hover:file:bg-[#111a35]">
                    <p class="mt-2 text-xs text-gray-500">Max 5 MB. Leave empty to keep the current image unless you check “Remove” above.</p>
                </div>

                <div class="border-l-4 border-navy bg-gray-50 px-4 py-3 text-sm text-gray-700">
                    <span class="font-semibold text-ink">Contact &amp; hours</span> — header bar and footer “Contact Us” area.
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" required
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Email</label>
                        <input type="email" name="email" value="{{ old('email', $setting->email) }}" required
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Working hours</label>
                    <input type="text" name="working_time" value="{{ old('working_time', $setting->working_time) }}" required
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Location</label>
                    <p class="mb-2 text-xs text-gray-500">Use line breaks for separate address lines (shown on the footer).</p>
                    <textarea name="location" rows="4" required
                              class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-800 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('location', $setting->location) }}</textarea>
                </div>

                <div class="overflow-hidden rounded-2xl border border-gray-100 bg-[#fafbfc]">
                    <div class="border-b border-gray-200 bg-white px-5 py-4">
                        <h3 class="font-heading text-sm font-bold uppercase tracking-wide text-ink">Social links</h3>
                        <p class="mt-1 text-xs text-gray-500">Footer uses Facebook, X, YouTube, and Instagram. The header also shows Pinterest.</p>
                    </div>
                    <div class="grid gap-4 p-5 sm:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-xs font-semibold text-gray-600">Facebook URL</label>
                            <input type="text" name="facebook_url" value="{{ old('facebook_url', $setting->facebook_url) }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="#">
                        </div>
                        <div>
                            <label class="mb-2 block text-xs font-semibold text-gray-600">X (Twitter) URL</label>
                            <input type="text" name="x_url" value="{{ old('x_url', $setting->x_url) }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="#">
                        </div>
                        <div>
                            <label class="mb-2 block text-xs font-semibold text-gray-600">YouTube URL</label>
                            <input type="text" name="youtube_url" value="{{ old('youtube_url', $setting->youtube_url) }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="#">
                        </div>
                        <div>
                            <label class="mb-2 block text-xs font-semibold text-gray-600">Instagram URL</label>
                            <input type="text" name="instagram_url" value="{{ old('instagram_url', $setting->instagram_url) }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="#">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-xs font-semibold text-gray-600">Pinterest URL</label>
                            <input type="text" name="pinterest_url" value="{{ old('pinterest_url', $setting->pinterest_url) }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="#">
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <button type="submit" class="rounded-lg bg-primary px-8 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                        Save changes
                    </button>
                    <a href="{{ url('/') }}" target="_blank" rel="noopener" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-wide text-ink hover:bg-gray-50">
                        Preview site
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
