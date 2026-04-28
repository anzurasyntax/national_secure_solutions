@php($isEdit = (bool) ($course?->exists))
@php
    $_faqRaw = old('faq_sections', $course?->faq_sections ?? []);
    $faqRows = is_array($_faqRaw) && $_faqRaw !== [] ? $_faqRaw : [['title' => '', 'body' => '']];
@endphp

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
    <p class="mt-1 text-xs text-gray-500">Optional overview; you can add structured FAQs below.</p>
</div>

<div class="mt-10 rounded-xl border border-gray-200 bg-[#fafbfc] p-6 lg:p-8">
    <h3 class="font-heading text-lg font-bold text-ink">Course detail page (public website)</h3>
    <p class="mt-1 text-sm text-gray-600">Controls categories, FAQ-style sections, learning outcomes, requirements, and sidebar meta on <code class="rounded bg-gray-100 px-1 text-xs">/courses/{{ $course?->slug ?? '{slug}' }}</code>.</p>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <div class="lg:col-span-2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Categories / tags</label>
            <input type="text" name="categories_input"
                   value="{{ old('categories_input', ($course && is_array($course->categories)) ? implode(', ', $course->categories) : '') }}"
                   class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                   placeholder="e.g. CCTV, Conflict Management, Security Guard">
        </div>
        <div>
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Level label</label>
            <input type="text" name="level_label" value="{{ old('level_label', $course?->level_label) }}"
                   class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                   placeholder="e.g. All Levels">
        </div>
        <div>
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Detail page “last updated”</label>
            <input type="date" name="detail_last_updated_at"
                   value="{{ old('detail_last_updated_at', $course?->detail_last_updated_at?->format('Y-m-d')) }}"
                   class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
        </div>
        <div class="lg:col-span-2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">What students will learn (one bullet per line)</label>
            <textarea name="learning_outcomes_input" rows="8"
                      class="w-full rounded-lg border border-gray-300 px-4 py-3 font-mono text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                      placeholder="Introduction to the security industry&#10;Report writing">{{ old('learning_outcomes_input', ($course && is_array($course->learning_outcomes)) ? implode("\n", $course->learning_outcomes) : '') }}</textarea>
        </div>
        <div class="lg:col-span-2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">FAQ / “About course” sections</label>
            <p class="mb-3 text-xs text-gray-500">Heading + answer blocks (shown like the Ontario training reference page).</p>
            <div id="faq-rows" class="space-y-4">
                @foreach ($faqRows as $i => $faqRow)
                    @php($faqRow = is_array($faqRow) ? $faqRow : ['title' => '', 'body' => ''])
                    <div class="faq-row rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
                        <div class="flex justify-between gap-4">
                            <label class="block flex-1 text-xs font-bold uppercase tracking-wide text-gray-600">
                                Heading
                                <input type="text" name="faq_sections[{{ $i }}][title]" value="{{ old('faq_sections.'.$i.'.title', $faqRow['title'] ?? '') }}"
                                       class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm font-normal outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                            </label>
                            <button type="button" class="faq-remove shrink-0 self-start rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-50">Remove</button>
                        </div>
                        <label class="mt-3 block text-xs font-bold uppercase tracking-wide text-gray-600">
                            Answer
                            <textarea name="faq_sections[{{ $i }}][body]" rows="4"
                                      class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm font-normal outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('faq_sections.'.$i.'.body', $faqRow['body'] ?? '') }}</textarea>
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="button" id="faq-add-row" class="mt-4 rounded-lg border border-dashed border-gray-300 bg-white px-4 py-2 text-xs font-bold uppercase tracking-wide text-gray-700 hover:border-primary hover:text-primary">
                + Add FAQ section
            </button>
        </div>
        <div class="lg:col-span-2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Material includes (one per line)</label>
            <textarea name="material_includes_input" rows="5"
                      class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                      placeholder="Interactive learning method">{{ old('material_includes_input', ($course && is_array($course->material_includes)) ? implode("\n", $course->material_includes) : '') }}</textarea>
        </div>
        <div class="lg:col-span-2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Requirements (one per line)</label>
            <textarea name="requirements_input" rows="5"
                      class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                      placeholder="Be 18 years of age or older">{{ old('requirements_input', ($course && is_array($course->requirements_list)) ? implode("\n", $course->requirements_list) : '') }}</textarea>
        </div>
        <div class="lg:col-span-2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Audience</label>
            <textarea name="audience" rows="4"
                      class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                      placeholder="Who this certification is for">{{ old('audience', $course?->audience) }}</textarea>
        </div>
    </div>
</div>

<div class="mt-6">
    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Cover image {{ $isEdit ? '(replace)' : '' }}</label>
    <input type="file" name="image" accept="image/*"
           class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-ink file:px-4 file:py-2 file:font-heading file:text-xs file:font-bold file:uppercase file:text-white hover:file:bg-[#111a35]">
    @if ($isEdit && $course->image_path)
        <p class="mt-2 text-xs text-gray-500">Current: <code class="rounded bg-gray-100 px-1">{{ $course->image_path }}</code></p>
    @endif
</div>

@push('scripts')
<script>
(function () {
    var wrap = document.getElementById('faq-rows');
    var addBtn = document.getElementById('faq-add-row');
    if (!wrap || !addBtn) return;

    function nextIndex() {
        return wrap.querySelectorAll('.faq-row').length;
    }

    function bindRemove(row) {
        var btn = row.querySelector('.faq-remove');
        if (!btn) return;
        btn.addEventListener('click', function () {
            if (wrap.querySelectorAll('.faq-row').length <= 1) return;
            row.remove();
        });
    }

    wrap.querySelectorAll('.faq-row').forEach(bindRemove);

    addBtn.addEventListener('click', function () {
        var i = nextIndex();
        var div = document.createElement('div');
        div.className = 'faq-row rounded-lg border border-gray-200 bg-white p-4 shadow-sm';
        div.innerHTML =
            '<div class="flex justify-between gap-4">' +
            '<label class="block flex-1 text-xs font-bold uppercase tracking-wide text-gray-600">Heading' +
            '<input type="text" name="faq_sections[' + i + '][title]" class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm font-normal outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">' +
            '</label>' +
            '<button type="button" class="faq-remove shrink-0 self-start rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-50">Remove</button>' +
            '</div>' +
            '<label class="mt-3 block text-xs font-bold uppercase tracking-wide text-gray-600">Answer' +
            '<textarea name="faq_sections[' + i + '][body]" rows="4" class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm font-normal outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"></textarea>' +
            '</label>';
        wrap.appendChild(div);
        bindRemove(div);
    });
})();
</script>
@endpush
