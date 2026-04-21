@extends('layouts.admin')

@section('title', 'Blog posts')

@section('heading', 'Blog posts')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <p class="text-sm text-gray-600">Published posts appear on the public blog. Drafts stay hidden until you set a publish date.</p>
        <a href="{{ route('admin.blog-posts.create') }}" class="rounded-lg bg-primary px-5 py-2.5 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
            New post
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gradient-to-r from-ink to-[#111a35] font-heading text-xs font-bold uppercase tracking-wide text-white">
                    <tr>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Published</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="max-w-md px-4 py-3">
                                <span class="font-medium text-ink">{{ $post->title }}</span>
                                @if ($post->categories->isNotEmpty())
                                    <p class="mt-1 text-xs text-gray-500">{{ $post->categories->pluck('name')->join(', ') }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if ($post->isPublished())
                                    <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-800">Live</span>
                                @else
                                    <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs font-semibold text-gray-700">Draft</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-600">
                                {{ $post->published_at?->format('M j, Y g:i A') ?? '—' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                @if ($post->isPublished())
                                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="mr-3 font-semibold text-navy hover:underline">View</a>
                                @endif
                                <a href="{{ route('admin.blog-posts.edit', $post) }}" class="font-semibold text-primary hover:underline">Edit</a>
                                <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="POST" class="ml-3 inline" onsubmit="return confirm('Delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-12 text-center text-gray-500">
                                No posts. <a href="{{ route('admin.blog-posts.create') }}" class="font-semibold text-primary hover:underline">Write one</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
