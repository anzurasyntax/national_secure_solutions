@php($isEdit = (bool) ($course?->exists))

<div class="grid gap-6 lg:grid-cols-2">
    <div class="lg:col-span-2">
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Title</label>
        <input type="text" name="title" value="{{ old('title', $course?->title) }}" required
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
    </div>

    <div class="lg:col-span-2">
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">URL slug</label>
        <input type="text" name="slug" value="{{ old('slug', $course?->slug) }}"
               placeholder="Leave blank to auto-generate"
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
        @error('slug')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Price</label>
        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $course?->price) }}" required
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
        @error('price')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Currency (ISO)</label>
        <input type="text" name="currency" maxlength="3" value="{{ old('currency', $course?->currency ?? 'USD') }}" required
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm uppercase outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
        @error('currency')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Est. duration (minutes)</label>
        <input type="number" name="duration_minutes" min="1" value="{{ old('duration_minutes', $course?->duration_minutes) }}"
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
               placeholder="Optional">
    </div>

    <div class="flex items-center gap-3 pt-8">
        <input type="checkbox" name="is_published" value="1" id="is_published" class="rounded border-gray-300 text-primary focus:ring-primary"
               {{ old('is_published', $course?->is_published ?? false) ? 'checked' : '' }}>
        <label for="is_published" class="text-sm font-semibold text-gray-700">Published on website</label>
    </div>
</div>

<div class="mt-6">
    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Summary</label>
    <textarea name="summary" rows="3"
              class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
              placeholder="Short card text">{{ old('summary', $course?->summary) }}</textarea>
</div>

<div class="mt-6">
    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Full description</label>
    <textarea name="description" rows="10"
              class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
              placeholder="Shown on course detail page">{{ old('description', $course?->description) }}</textarea>
</div>

<div class="mt-6">
    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Cover image {{ $isEdit ? '(replace)' : '' }}</label>
    <input type="file" name="image" accept="image/*"
           class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-ink file:px-4 file:py-2 file:font-heading file:text-xs file:font-bold file:uppercase file:text-white hover:file:bg-[#111a35]">
    @if ($isEdit && $course->image_path)
        <p class="mt-2 text-xs text-gray-500">Current: <code class="rounded bg-gray-100 px-1">{{ $course->image_path }}</code></p>
    @endif
</div>
