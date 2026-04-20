@php($isEdit = (bool) ($service?->exists))

<div class="grid gap-6 lg:grid-cols-2">
    <div class="lg:col-span-2">
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Title</label>
        <input type="text" name="title" value="{{ old('title', $service?->title) }}" required
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
    </div>
    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Sort order</label>
        <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $service?->sort_order) }}"
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
               placeholder="Auto if empty">
    </div>
</div>

<div>
    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Short description (card)</label>
    <textarea name="excerpt" rows="4" required
              class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('excerpt', $service?->excerpt) }}</textarea>
</div>

<div>
    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Full detail (optional — shown on Services page only)</label>
    <textarea name="body" rows="8"
              class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
              placeholder="Optional HTML or plain text">{{ old('body', $service?->body) }}</textarea>
</div>

<div class="grid gap-6 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Cover image {{ $isEdit ? '(replace)' : '' }}</label>
        <input type="file" name="image" accept="image/*" {{ $isEdit ? '' : 'required' }}
               class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-ink file:px-4 file:py-2 file:font-heading file:text-xs file:font-bold file:uppercase file:text-white hover:file:bg-[#111a35]">
        @if ($isEdit && $service->image_path)
            <p class="mt-2 text-xs text-gray-500">Current: <code class="rounded bg-gray-100 px-1">{{ $service->image_path }}</code></p>
        @endif
    </div>
    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Icon {{ $isEdit ? '(replace)' : '' }}</label>
        <input type="file" name="icon" accept="image/*" {{ $isEdit ? '' : 'required' }}
               class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-ink file:px-4 file:py-2 file:font-heading file:text-xs file:font-bold file:uppercase file:text-white hover:file:bg-[#111a35]">
        @if ($isEdit && $service->icon_path)
            <p class="mt-2 text-xs text-gray-500">Current: <code class="rounded bg-gray-100 px-1">{{ $service->icon_path }}</code></p>
        @endif
    </div>
</div>
