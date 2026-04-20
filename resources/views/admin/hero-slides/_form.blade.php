@php
    /** @var \App\Models\HeroSlide|null $slide */
    $isEdit = $slide !== null;
@endphp

<div class="space-y-6">
    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Background image {{ $isEdit ? '(leave empty to keep current)' : '' }}</label>
        <input type="file" name="image" accept="image/*" {{ $isEdit ? '' : 'required' }}
               class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-ink file:px-4 file:py-2 file:font-heading file:text-xs file:font-bold file:uppercase file:tracking-wide file:text-white hover:file:bg-[#111a35]">
        @if ($isEdit && $slide->image_path)
            <p class="mt-2 text-xs text-gray-500">Current: <code class="rounded bg-gray-100 px-1">{{ $slide->image_path }}</code></p>
        @endif
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Sort order</label>
            <input type="number" name="sort_order" min="0" max="9999"
                   value="{{ old('sort_order', $slide->sort_order ?? ($nextOrder ?? 1)) }}"
                   class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
        </div>
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Tagline <span class="font-normal normal-case text-gray-400">(optional — if set, uses banner layout with H1)</span></label>
        <input type="text" name="tagline" value="{{ old('tagline', $slide->tagline ?? '') }}"
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
               placeholder="Securing is our best part of life">
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Headline</label>
        <textarea name="headline" rows="3" required
                  class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('headline', $slide->headline ?? '') }}</textarea>
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Subtitle <span class="font-normal normal-case text-gray-400">(optional — shown in red below headline when no tagline)</span></label>
        <input type="text" name="subtitle" value="{{ old('subtitle', $slide->subtitle ?? '') }}"
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Button label</label>
            <input type="text" name="button_label" value="{{ old('button_label', $slide->button_label ?? 'Get Inquiry') }}"
                   class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
        </div>
        <div>
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Button URL</label>
            <input type="text" name="button_url" value="{{ old('button_url', $slide->button_url ?? '#') }}"
                   class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                   placeholder="#">
        </div>
    </div>
</div>
