@php
    $isEdit = isset($post);
@endphp

<div class="grid gap-6 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Title</label>
        <input type="text" name="title" required value="{{ old('title', $post->title ?? '') }}"
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-ink outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
        @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">URL slug <span class="font-normal normal-case text-gray-400">(optional — generated from title if empty)</span></label>
        <input type="text" name="slug" value="{{ old('slug', $post->slug ?? '') }}"
               class="w-full rounded-lg border border-gray-300 px-4 py-3 font-mono text-sm text-ink outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
               placeholder="auto-from-title">
        @error('slug')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Excerpt</label>
        <textarea name="excerpt" rows="3"
                  class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-ink outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
        @error('excerpt')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Body</label>
        <textarea name="body" rows="12"
                  class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-ink outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('body', $post->body ?? '') }}</textarea>
        @error('body')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Featured image</label>
        @if ($isEdit && $post->featured_image_path)
            <div class="mb-3 flex items-center gap-4">
                <img src="{{ asset($post->featured_image_path) }}" alt="" class="h-24 w-auto max-w-[200px] rounded-lg border border-gray-200 object-cover">
                <span class="text-xs text-gray-500">Upload a new file to replace.</span>
            </div>
        @endif
        <input type="file" name="featured_image" accept="image/*"
               class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:font-semibold file:text-ink hover:file:bg-gray-200">
        @error('featured_image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Publish date</label>
        <input type="datetime-local" name="published_at"
               value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-ink outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
        <p class="mt-1 text-xs text-gray-500">Leave empty for a draft. Set a past or future date to schedule.</p>
        @error('published_at')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Sort order</label>
        <input type="number" name="sort_order" min="0" max="99999"
               value="{{ old('sort_order', $post->sort_order ?? 0) }}"
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-ink outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
        @error('sort_order')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    @if (!$isEdit)
        <div class="flex items-center gap-3 md:col-span-2">
            <input type="hidden" name="publish_now" value="0">
            <input type="checkbox" name="publish_now" id="publish_now" value="1" class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary"
                   {{ old('publish_now') ? 'checked' : '' }}>
            <label for="publish_now" class="text-sm font-medium text-ink">Publish immediately <span class="text-gray-500">(sets date to now)</span></label>
        </div>
    @else
        <div class="flex flex-wrap gap-6 md:col-span-2">
            <div class="flex items-center gap-3">
                <input type="hidden" name="publish_now" value="0">
                <input type="checkbox" name="publish_now" id="publish_now" value="1" class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                <label for="publish_now" class="text-sm font-medium text-ink">Publish / set live now</label>
            </div>
            <div class="flex items-center gap-3">
                <input type="hidden" name="clear_published" value="0">
                <input type="checkbox" name="clear_published" id="clear_published" value="1" class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                <label for="clear_published" class="text-sm font-medium text-ink">Revert to draft</label>
            </div>
        </div>
    @endif

    <div class="md:col-span-2">
        <p class="mb-3 text-xs font-bold uppercase tracking-wide text-gray-600">Categories</p>
        <div class="flex flex-wrap gap-4">
            @forelse ($categories as $category)
                <label class="inline-flex items-center gap-2 text-sm text-ink">
                    <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                           class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary"
                        {{ in_array($category->id, old('category_ids', isset($post) ? $post->categories->pluck('id')->all() : []), true) ? 'checked' : '' }}>
                    {{ $category->name }}
                </label>
            @empty
                <p class="text-sm text-gray-500">No categories yet. <a href="{{ route('admin.blog-categories.create') }}" class="font-semibold text-primary hover:underline">Create one</a>.</p>
            @endforelse
        </div>
        @error('category_ids')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <p class="mb-3 text-xs font-bold uppercase tracking-wide text-gray-600">Tags</p>
        <div class="flex flex-wrap gap-4">
            @forelse ($tags as $tag)
                <label class="inline-flex items-center gap-2 text-sm text-ink">
                    <input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}"
                           class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary"
                        {{ in_array($tag->id, old('tag_ids', isset($post) ? $post->tags->pluck('id')->all() : []), true) ? 'checked' : '' }}>
                    {{ $tag->name }}
                </label>
            @empty
                <p class="text-sm text-gray-500">No tags yet. <a href="{{ route('admin.blog-tags.create') }}" class="font-semibold text-primary hover:underline">Create one</a>.</p>
            @endforelse
        </div>
        @error('tag_ids')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
</div>
