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
        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Module media</label>
        <input type="file" name="material_files[]"
               accept="video/*,image/*,.ppt,.pptx,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation"
               multiple
               class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-ink file:px-4 file:py-2 file:font-heading file:text-xs file:font-bold file:uppercase file:text-white hover:file:bg-[#111a35]">
        @error('material_files')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
        @error('material_files.*')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror

        @php
            $materialsForForm = $module ? $module->materialsList() : [];
        @endphp
        @if (count($materialsForForm))
            <div class="mt-3 rounded-lg border border-gray-200 bg-gray-50 p-3">
                <p class="text-xs font-semibold uppercase tracking-wide text-gray-600">Current uploads (check to remove when saving)</p>
                <ul class="mt-2 space-y-2 text-xs text-gray-700">
                    @foreach ($materialsForForm as $m)
                        <li class="flex flex-wrap items-start gap-2 rounded border border-gray-200 bg-white p-2">
                            <label class="inline-flex items-start gap-2">
                                <input type="checkbox" name="remove_material_ids[]" value="{{ $m['id'] }}"
                                       class="mt-0.5 rounded border-gray-300 text-primary focus:ring-primary">
                                <span>
                                    <span class="font-semibold uppercase text-gray-500">{{ $m['type'] }}</span>
                                    <span class="ml-1">{{ $m['name'] }}</span>
                                </span>
                            </label>
                        </li>
                    @endforeach
                </ul>
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
        if ($module !== null && $module->lesson_outline && is_array($module->lesson_outline)) {
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
