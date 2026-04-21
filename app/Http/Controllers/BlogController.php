<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $query = BlogPost::query()->published()->with(['categories', 'tags']);

        if ($request->filled('category')) {
            $slug = $request->string('category')->toString();
            $query->whereHas('categories', fn ($q) => $q->where('slug', $slug));
        }

        if ($request->filled('tag')) {
            $slug = $request->string('tag')->toString();
            $query->whereHas('tags', fn ($q) => $q->where('slug', $slug));
        }

        if ($request->filled('q')) {
            $term = $request->string('q')->trim()->toString();
            $like = '%'.$term.'%';
            $query->where(fn ($w) => $w->where('title', 'like', $like)->orWhere('excerpt', 'like', $like));
        }

        $posts = $query->ordered()->paginate(12)->withQueryString();

        $recentPosts = BlogPost::query()->published()->ordered()->limit(5)->get();
        $sidebarLatest = BlogPost::query()->published()->ordered()->limit(4)->get();
        $categories = BlogCategory::query()->orderBy('sort_order')->orderBy('name')->get();
        $tags = BlogTag::query()->orderBy('sort_order')->orderBy('name')->get();

        return view('blog.index', compact(
            'posts',
            'recentPosts',
            'sidebarLatest',
            'categories',
            'tags'
        ));
    }

    public function show(string $slug): View
    {
        $post = BlogPost::query()
            ->published()
            ->where('slug', $slug)
            ->with(['categories', 'tags'])
            ->firstOrFail();

        $recentPosts = BlogPost::query()
            ->published()
            ->where('id', '!=', $post->id)
            ->ordered()
            ->limit(5)
            ->get();

        return view('blog.show', compact('post', 'recentPosts'));
    }
}
