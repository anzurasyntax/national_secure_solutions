@extends('layouts.admin')

@section('title', 'Site & footer')

@section('heading', 'Site & footer')

@section('content')
    <div class="space-y-8">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-6 text-white">
                <h2 class="font-heading text-lg font-bold uppercase tracking-wide">Contact &amp; hours</h2>
                <p class="mt-1 text-sm text-white/70">These values power the header bar and footer “Contact Us” area on the public site.</p>
            </div>

            <form method="POST" action="{{ route('admin.site-settings.update') }}" class="space-y-6 px-6 py-8">
                @csrf
                @method('PUT')

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
