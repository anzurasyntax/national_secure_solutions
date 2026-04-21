<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    public function index(): View
    {
        $categories = BlogCategory::query()->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.blog-categories.create');
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
        $validated['sort_order'] = $validated['sort_order'] ?? (((int) (BlogCategory::query()->max('sort_order') ?? 0)) + 1);

        BlogCategory::query()->create($validated);

        return redirect()->route('admin.blog-categories.index')->with('status', 'Category created.');
    }

    public function edit(BlogCategory $blogCategory): View
    {
        return view('admin.blog-categories.edit', compact('blogCategory'));
    }

    public function update(Request $request, BlogCategory $blogCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
        ]);

        $slug = Str::slug($validated['slug'] ?: $validated['name']);
        $validated['slug'] = $this->uniqueSlug($slug, $blogCategory->id);

        $blogCategory->update($validated);

        return redirect()->route('admin.blog-categories.index')->with('status', 'Category updated.');
    }

    public function destroy(BlogCategory $blogCategory): RedirectResponse
    {
        $blogCategory->delete();

        return redirect()->route('admin.blog-categories.index')->with('status', 'Category deleted.');
    }

    private function uniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $slug = trim($slug, '-') ?: 'category';
        $original = $slug;
        $i = 2;
        while (BlogCategory::query()
            ->where('slug', $slug)
            ->when($ignoreId !== null, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $original.'-'.$i;
            $i++;
        }

        return $slug;
    }
}
