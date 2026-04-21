<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogTagController extends Controller
{
    public function index(): View
    {
        $tags = BlogTag::query()->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.blog-tags.index', compact('tags'));
    }

    public function create(): View
    {
        return view('admin.blog-tags.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
        ]);

        $slug = Str::slug($validated['slug'] ?: $validated['name']);
        $validated['slug'] = $this->uniqueSlug($slug);
        $validated['sort_order'] = $validated['sort_order'] ?? (((int) (BlogTag::query()->max('sort_order') ?? 0)) + 1);

        BlogTag::query()->create($validated);

        return redirect()->route('admin.blog-tags.index')->with('status', 'Tag created.');
    }

    public function edit(BlogTag $blogTag): View
    {
        return view('admin.blog-tags.edit', compact('blogTag'));
    }

    public function update(Request $request, BlogTag $blogTag): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
        ]);

        $slug = Str::slug($validated['slug'] ?: $validated['name']);
        $validated['slug'] = $this->uniqueSlug($slug, $blogTag->id);

        $blogTag->update($validated);

        return redirect()->route('admin.blog-tags.index')->with('status', 'Tag updated.');
    }

    public function destroy(BlogTag $blogTag): RedirectResponse
    {
        $blogTag->delete();

        return redirect()->route('admin.blog-tags.index')->with('status', 'Tag deleted.');
    }

    private function uniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $slug = trim($slug, '-') ?: 'tag';
        $original = $slug;
        $i = 2;
        while (BlogTag::query()
            ->where('slug', $slug)
            ->when($ignoreId !== null, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $original.'-'.$i;
            $i++;
        }

        return $slug;
    }
}
