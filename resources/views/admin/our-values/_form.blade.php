@php
    $value = $value ?? null;
    $isEdit = $value !== null;
@endphp

<div class="grid gap-6 md:grid-cols-2">
    <div>
        <label for="eyebrow" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Eyebrow (upper label)</label>
        <input type="text" id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $value?->eyebrow) }}" required maxlength="255"
               class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-ink shadow-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30">
        @error('eyebrow') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="sort_order" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Sort order</label>
        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $value?->sort_order) }}" min="0" max="99999"
               class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-ink shadow-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30">
        @error('sort_order') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="grid gap-6 md:grid-cols-2">
    <div>
        <label for="line1" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Heading line 1</label>
        <input type="text" id="line1" name="line1" value="{{ old('line1', $value?->line1) }}" required maxlength="255"
               class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-ink shadow-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30"
               placeholder='e.g. Customer Focus:'>
        @error('line1') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="line2" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Heading line 2</label>
        <input type="text" id="line2" name="line2" value="{{ old('line2', $value?->line2) }}" required maxlength="255"
               class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-ink shadow-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30"
               placeholder="e.g. Customer comes first">
        @error('line2') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-6">
    <p class="text-sm font-semibold text-ink">Image</p>
    <p class="mt-1 text-xs text-gray-600">
        @if ($isEdit)
            Upload a new file to replace the image, or paste an external URL (seeder defaults use Unsplash URLs).
        @else
            Upload a JPEG/PNG/WebP or paste an image URL (HTTPS).
        @endif
    </p>
    <div class="mt-4 grid gap-6 md:grid-cols-2">
        <div>
            <label for="image" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Upload</label>
            <input type="file" id="image" name="image" accept="image/*"
                   class="mt-2 block w-full text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:font-semibold file:text-primary hover:file:bg-primary/20">
            @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="image_url" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Image URL (optional)</label>
            <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}"
                   class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-ink shadow-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30"
                   placeholder="https://…">
            @error('image_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>
    @if ($isEdit && $value?->image_path)
        <div class="mt-4 flex items-start gap-4">
            <div class="h-24 w-36 overflow-hidden rounded-lg border border-gray-200 bg-gray-200 bg-cover bg-center" style="background-image: url('{{ $value->imageSrc() }}')"></div>
            <p class="text-xs text-gray-500">Current image. Leave upload and URL empty to keep it; set URL to switch to external; upload to store under <code class="font-mono">public/img/our-values/</code>.</p>
        </div>
    @endif
</div>
