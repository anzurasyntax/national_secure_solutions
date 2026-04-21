<div class="grid gap-6">
    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Title</label>
        <input type="text" name="title" value="{{ old('title', $module?->title) }}" required
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Sort order</label>
        <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $module?->sort_order) }}"
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
               placeholder="Auto if empty">
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Video embed URL</label>
        <input type="url" name="video_url" value="{{ old('video_url', $module?->video_url) }}"
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
               placeholder="https://www.youtube.com/embed/...">
        <p class="mt-1 text-xs text-gray-500">Use an embed-friendly HTTPS URL (YouTube embed links work best).</p>
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Lesson content</label>
        <textarea name="body" rows="12"
                  class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                  placeholder="Instructions, reading, resources...">{{ old('body', $module?->body) }}</textarea>
    </div>
</div>
