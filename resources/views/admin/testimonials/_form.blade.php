@php
    $t = $testimonial ?? null;
    $isEdit = $t !== null;
@endphp

<div>
    <label for="body" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Review text</label>
    <textarea id="body" name="body" rows="6" required maxlength="50000"
              class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-ink shadow-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30">{{ old('body', $t?->body) }}</textarea>
    @error('body') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="grid gap-6 md:grid-cols-2">
    <div>
        <label for="name" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Client name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $t?->name) }}" required maxlength="255"
               class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-ink shadow-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30">
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="role" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Role / title</label>
        <input type="text" id="role" name="role" value="{{ old('role', $t?->role) }}" required maxlength="255"
               class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-ink shadow-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30">
        @error('role') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="grid gap-6 md:grid-cols-3">
    <div>
        <label for="rating" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Star rating</label>
        <select id="rating" name="rating" required class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-ink shadow-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30">
            @foreach (range(5, 1, -1) as $stars)
                <option value="{{ $stars }}" @selected(old('rating', $t?->rating ?? 5) == $stars)>{{ $stars }} stars</option>
            @endforeach
        </select>
        @error('rating') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="md:col-span-2">
        <label for="sort_order" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Sort order</label>
        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $t?->sort_order) }}" min="0" max="99999"
               class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-ink shadow-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30 md:max-w-xs">
        @error('sort_order') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-6">
    <p class="text-sm font-semibold text-ink">Avatar</p>
    <p class="mt-1 text-xs text-gray-600">
        Upload a square photo or paste an image URL. Seed default uses <code class="font-mono text-xs">img/profile.png</code>.
    </p>
    <div class="mt-4 grid gap-6 md:grid-cols-2">
        <div>
            <label for="avatar" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Upload</label>
            <input type="file" id="avatar" name="avatar" accept="image/*"
                   class="mt-2 block w-full text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:font-semibold file:text-primary hover:file:bg-primary/20">
            @error('avatar') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="avatar_url" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Image URL</label>
            <input type="text" id="avatar_url" name="avatar_url" value="{{ old('avatar_url') }}"
                   class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-ink shadow-sm focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30"
                   placeholder="/img/profile.png or https://…">
            @error('avatar_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>
    @if ($isEdit && $t?->avatar_path)
        <div class="mt-4 flex items-start gap-4">
            <div class="h-16 w-16 shrink-0 overflow-hidden rounded-full border-2 border-gray-200 bg-gray-200 bg-cover bg-center" style="background-image: url('{{ $t->avatarUrl() }}')"></div>
            <p class="text-xs text-gray-500">Current avatar. Leave empty to keep; URL or upload replaces it (uploads go to <code class="font-mono">public/img/testimonials/</code>).</p>
        </div>
    @endif
</div>
