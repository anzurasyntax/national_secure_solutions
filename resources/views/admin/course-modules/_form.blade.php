<div class="grid gap-6">
    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Title</label>
        <input type="text" name="title" value="{{ old('title', $module?->title) }}" required
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Module duration (minutes)</label>
        <input type="number" name="duration_minutes" min="1" max="99999"
               value="{{ old('duration_minutes', $module?->duration_minutes) }}"
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
               placeholder="e.g. 120 for 2 hours">
        <p class="mt-1 text-xs text-gray-500">Shown on the public course outline next to this module.</p>
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Sort order</label>
        <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $module?->sort_order) }}"
               class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
               placeholder="Auto if empty">
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Upload module video(s)</label>
        <input type="file" name="video_files[]" accept="video/mp4,video/webm,video/ogg,video/quicktime,video/x-msvideo,video/x-matroska" multiple
               class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-ink file:px-4 file:py-2 file:font-heading file:text-xs file:font-bold file:uppercase file:text-white hover:file:bg-[#111a35]">
        <p class="mt-1 text-xs text-gray-500">You can select multiple video files (max 200MB each).</p>
        @error('video_files')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
        @error('video_files.*')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror

        @if ($module?->video_paths && is_array($module->video_paths) && count($module->video_paths))
            <div class="mt-3 rounded-lg border border-gray-200 bg-gray-50 p-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-gray-600">Current uploaded videos</p>
                <ul class="mt-2 space-y-1 text-xs text-gray-600">
                    @foreach ($module->video_paths as $videoPath)
                        <li><code class="rounded bg-white px-1 py-0.5">{{ $videoPath }}</code></li>
                    @endforeach
                </ul>
                <label class="mt-3 inline-flex items-center gap-2 text-xs text-red-700">
                    <input type="checkbox" name="remove_existing_videos" value="1" class="rounded border-gray-300 text-primary focus:ring-primary">
                    Remove current videos (if no new file is uploaded)
                </label>
            </div>
        @endif
    </div>

    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Lesson content</label>
        <textarea name="body" rows="12"
                  class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                  placeholder="Instructions, reading, resources...">{{ old('body', $module?->body) }}</textarea>
    </div>

    @php
        $outlineLines = '';
        if ($module?->lesson_outline && is_array($module->lesson_outline)) {
            $outlineLines = collect($module->lesson_outline)->map(function ($row) {
                $row = is_array($row) ? $row : [];
                $label = $row['label'] ?? '';
                $dur = $row['duration_label'] ?? null;

                return $dur ? $label.' | '.$dur : $label;
            })->filter()->implode("\n");
        }
    @endphp
    <div>
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Lesson outline (public)</label>
        <textarea name="lesson_outline_input" rows="6"
                  class="w-full rounded-lg border border-gray-300 px-4 py-3 font-mono text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                  placeholder="Presentation | 02:00:00&#10;Quiz | Module 1">{{ old('lesson_outline_input', $outlineLines) }}</textarea>
        <p class="mt-1 text-xs text-gray-500">One row per line. Optional duration after a pipe (<code class="rounded bg-gray-100 px-1">|</code>), e.g. <code class="rounded bg-gray-100 px-1">Presentation | 02:00:00</code>.</p>
    </div>
</div>
