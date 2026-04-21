<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::query()
            ->with(['categories', 'tags'])
            ->orderByDesc('sort_order')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();

        return view('admin.blog-posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = BlogCategory::query()->orderBy('sort_order')->orderBy('name')->get();
        $tags = BlogTag::query()->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.blog-posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePost($request);
        $slugInput = trim((string) ($validated['slug'] ?? ''));
        $validated['slug'] = $slugInput !== ''
            ? $this->uniqueSlug(BlogPost::class, Str::slug($slugInput))
            : $this->uniqueSlug(BlogPost::class, Str::slug($validated['title']));

        if ($request->boolean('publish_now')) {
            $validated['published_at'] = now();
        } elseif (empty($validated['published_at'])) {
            $validated['published_at'] = null;
        }

        unset($validated['publish_now'], $validated['clear_published']);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image_path'] = $this->storeFeaturedImage($request->file('featured_image'));
        }
        unset($validated['featured_image']);

        $categoryIds = $validated['category_ids'] ?? [];
        $tagIds = $validated['tag_ids'] ?? [];
        unset($validated['category_ids'], $validated['tag_ids']);

        $validated['sort_order'] = $validated['sort_order'] ?? (((int) (BlogPost::query()->max('sort_order') ?? 0)) + 1);

        $post = BlogPost::query()->create($validated);
        $post->categories()->sync($categoryIds);
        $post->tags()->sync($tagIds);

        return redirect()->route('admin.blog-posts.index')->with('status', 'Blog post created.');
    }

    public function edit(BlogPost $blogPost): View
    {
        $categories = BlogCategory::query()->orderBy('sort_order')->orderBy('name')->get();
        $tags = BlogTag::query()->orderBy('sort_order')->orderBy('name')->get();
        $post = $blogPost->load(['categories', 'tags']);

        return view('admin.blog-posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, BlogPost $blogPost): RedirectResponse
    {
        $validated = $this->validatePost($request);

        $slugInput = trim((string) ($validated['slug'] ?? ''));
        unset($validated['slug']);
        if ($slugInput !== '') {
            $validated['slug'] = $this->uniqueSlug(BlogPost::class, Str::slug($slugInput), $blogPost->id);
        } else {
            $validated['slug'] = $this->uniqueSlug(BlogPost::class, Str::slug($validated['title']), $blogPost->id);
        }

        if ($request->boolean('clear_published')) {
            $validated['published_at'] = null;
        } elseif ($request->boolean('publish_now')) {
            $validated['published_at'] = $validated['published_at'] ?? now();
        }

        unset($validated['publish_now'], $validated['clear_published']);

        if ($request->hasFile('featured_image')) {
            $this->deleteFeaturedImage($blogPost->featured_image_path);
            $validated['featured_image_path'] = $this->storeFeaturedImage($request->file('featured_image'));
        }
        unset($validated['featured_image']);

        $categoryIds = $validated['category_ids'] ?? [];
        $tagIds = $validated['tag_ids'] ?? [];
        unset($validated['category_ids'], $validated['tag_ids']);

        $blogPost->update($validated);
        $blogPost->categories()->sync($categoryIds);
        $blogPost->tags()->sync($tagIds);

        return redirect()->route('admin.blog-posts.index')->with('status', 'Blog post updated.');
    }

    public function destroy(BlogPost $blogPost): RedirectResponse
    {
        $this->deleteFeaturedImage($blogPost->featured_image_path);
        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')->with('status', 'Blog post deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatePost(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:5000'],
            'body' => ['nullable', 'string', 'max:100000'],
            'featured_image' => ['nullable', 'image', 'max:5120'],
            'published_at' => ['nullable', 'date'],
            'publish_now' => ['sometimes', 'boolean'],
            'clear_published' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
            'category_ids' => ['nullable', 'array'],
            'category_ids.*' => ['integer', 'exists:blog_categories,id'],
            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => ['integer', 'exists:blog_tags,id'],
        ]);
    }

    /**
     * @param  class-string<\Illuminate\Database\Eloquent\Model>  $modelClass
     */
    private function uniqueSlug(string $modelClass, string $slug, ?int $ignoreId = null): string
    {
        $slug = trim($slug, '-') ?: 'post';
        $original = $slug;
        $i = 2;
        while ($modelClass::query()
            ->where('slug', $slug)
            ->when($ignoreId !== null, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $original.'-'.$i;
            $i++;
        }

        return $slug;
    }

    private function storeFeaturedImage(\Illuminate\Http\UploadedFile $file): string
    {
        $dir = public_path('img/blog');
        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $basename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $basename = preg_replace('/[^a-zA-Z0-9_-]+/', '-', $basename ?? 'image');
        $basename = trim((string) $basename, '-') ?: 'image';
        $filename = $basename.'-'.uniqid('', true).'.'.$extension;

        $file->move($dir, $filename);

        return 'img/blog/'.$filename;
    }

    private function deleteFeaturedImage(?string $path): void
    {
        if ($path === null || $path === '' || ! str_starts_with($path, 'img/blog/')) {
            return;
        }

        $full = public_path($path);
        if (File::exists($full)) {
            File::delete($full);
        }
    }
}
