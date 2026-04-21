@extends('layouts.app')

@section('title', 'Latest Posts | '.config('app.name'))

@section('content')
    @include('sections.header', ['pageTitle' => 'Latest Posts'])

    <div class="bg-[#f8f9fb]">
        <div class="mx-auto max-w-[1170px] px-4 py-12 md:px-6 md:py-16 lg:py-20">
            <div class="flex flex-col gap-10 lg:flex-row lg:gap-12">

                {{-- Main: post grid --}}
                <div class="min-w-0 flex-1">
                    @if (request()->filled('category') || request()->filled('tag') || request()->filled('q'))
                        <div class="mb-6 rounded-lg border border-gray-200 bg-white px-4 py-3 text-sm text-[#444]">
                            Showing results
                            @if (request()->filled('q'))
                                for “{{ request('q') }}”
                            @endif
                            @if (request()->filled('category'))
                                in <strong class="text-ink">{{ $categories->firstWhere('slug', request('category'))?->name ?? 'category' }}</strong>
                            @endif
                            @if (request()->filled('tag'))
                                tagged <strong class="text-ink">{{ $tags->firstWhere('slug', request('tag'))?->name ?? 'tag' }}</strong>
                            @endif
                            · <a href="{{ route('blog') }}" class="font-semibold text-primary hover:underline">Clear filters</a>
                        </div>
                    @endif

                    <div class="grid gap-8 sm:grid-cols-2">
                        @forelse ($posts as $blogPost)
                            <article class="group flex flex-col overflow-hidden rounded-lg border border-[#eeeeee] bg-white shadow-[0_8px_30px_rgba(0,0,0,0.06)] transition-shadow hover:shadow-[0_12px_40px_rgba(0,0,0,0.08)]">
                                @if ($blogPost->featuredImageUrl())
                                    <a href="{{ route('blog.show', $blogPost->slug) }}" class="relative block aspect-[16/10] overflow-hidden bg-gray-100">
                                        <img src="{{ $blogPost->featuredImageUrl() }}" alt=""
                                             class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]"
                                             loading="lazy" width="640" height="400">
                                    </a>
                                @endif
                                <div class="flex flex-1 flex-col p-6 pt-5">
                                    @if ($blogPost->published_at)
                                        <p class="mb-3 flex items-center gap-2 font-heading text-[11px] font-semibold uppercase tracking-[0.12em] text-[#888]">
                                            <svg class="h-4 w-4 shrink-0 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                            </svg>
                                            {{ strtoupper($blogPost->published_at->format('F j, Y')) }}
                                        </p>
                                    @endif
                                    <h2 class="font-heading text-xl font-bold leading-snug text-ink md:text-[22px]">
                                        <a href="{{ route('blog.show', $blogPost->slug) }}" class="text-ink transition-colors hover:text-primary">{{ $blogPost->title }}</a>
                                    </h2>
                                    @if ($blogPost->excerpt)
                                        <p class="mt-3 flex-1 text-base leading-relaxed text-[#797979]">{{ \Illuminate\Support\Str::limit($blogPost->excerpt, 160) }}</p>
                                    @endif
                                    <a href="{{ route('blog.show', $blogPost->slug) }}" class="mt-5 inline-flex items-center gap-2 font-heading text-sm font-semibold text-primary transition hover:gap-3">
                                        <span class="text-ink">—</span> Read More
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        @empty
                            <div class="sm:col-span-2 rounded-xl border border-dashed border-gray-300 bg-white px-8 py-16 text-center text-[#797979]">
                                <p class="font-heading text-lg font-semibold text-ink">No posts yet</p>
                                <p class="mt-2 text-sm">Check back soon — new articles are added from the admin panel.</p>
                            </div>
                        @endforelse
                    </div>

                    @if ($posts->hasPages())
                        <div class="mt-10 flex justify-center">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <aside class="w-full shrink-0 lg:w-[340px] xl:w-[360px]">
                    <div class="sticky top-28 space-y-8">

                        <div class="relative overflow-hidden rounded-lg border border-[#eeeeee] bg-white pb-6 pt-9 shadow-sm">
                            <div class="pointer-events-none absolute left-1/2 top-0 h-5 w-[88px] -translate-x-1/2 rounded-b-full bg-[#fde8ea]"></div>
                            <div class="px-5">
                                <h3 class="font-heading text-lg font-bold uppercase tracking-wide text-ink">Search</h3>
                                <form class="mt-4 flex gap-0" action="{{ route('blog') }}" method="get" role="search">
                                    @if (request()->filled('category'))
                                        <input type="hidden" name="category" value="{{ request('category') }}">
                                    @endif
                                    @if (request()->filled('tag'))
                                        <input type="hidden" name="tag" value="{{ request('tag') }}">
                                    @endif
                                    <label class="sr-only" for="blog-search">Search posts</label>
                                    <input id="blog-search" type="search" name="q" value="{{ request('q') }}" placeholder="Search..."
                                           class="h-11 min-w-0 flex-1 border border-[#ddd] px-3 text-sm text-ink outline-none focus:border-primary focus:ring-1 focus:ring-primary/30">
                                    <button type="submit" class="h-11 shrink-0 bg-primary px-5 font-heading text-xs font-bold uppercase tracking-wide text-white transition hover:bg-red-700">
                                        Search
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="relative overflow-hidden rounded-lg border border-[#eeeeee] bg-white pb-6 pt-9 shadow-sm">
                            <div class="pointer-events-none absolute left-1/2 top-0 h-5 w-[88px] -translate-x-1/2 rounded-b-full bg-[#fde8ea]"></div>
                            <div class="px-5">
                                <h3 class="font-heading text-lg font-bold uppercase tracking-wide text-ink">Recent Posts</h3>
                                <ul class="mt-4 space-y-3">
                                    @forelse ($recentPosts as $rp)
                                        <li>
                                            <a href="{{ route('blog.show', $rp->slug) }}" class="text-[15px] font-medium leading-snug text-[#444] transition hover:text-primary">{{ $rp->title }}</a>
                                        </li>
                                    @empty
                                        <li class="text-sm text-gray-500">No posts yet.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="relative overflow-hidden rounded-lg border border-[#eeeeee] bg-white pb-6 pt-9 shadow-sm">
                            <div class="pointer-events-none absolute left-1/2 top-0 h-5 w-[88px] -translate-x-1/2 rounded-b-full bg-[#fde8ea]"></div>
                            <div class="px-5">
                                <h3 class="font-heading text-lg font-bold uppercase tracking-wide text-ink">Recent Comments</h3>
                                <p class="mt-4 text-sm text-[#797979]">No comments to show.</p>
                            </div>
                        </div>

                        <div class="relative overflow-hidden rounded-lg border border-[#eeeeee] bg-white pb-6 pt-9 shadow-sm">
                            <div class="pointer-events-none absolute left-1/2 top-0 h-5 w-[88px] -translate-x-1/2 rounded-b-full bg-[#fde8ea]"></div>
                            <div class="px-5">
                                <form class="flex gap-0" action="{{ route('blog') }}" method="get">
                                    @if (request()->filled('category'))
                                        <input type="hidden" name="category" value="{{ request('category') }}">
                                    @endif
                                    @if (request()->filled('tag'))
                                        <input type="hidden" name="tag" value="{{ request('tag') }}">
                                    @endif
                                    <label class="sr-only" for="blog-search-sidebar">Search</label>
                                    <input id="blog-search-sidebar" type="search" name="q" value="{{ request('q') }}" placeholder="Search..."
                                           class="h-10 min-w-0 flex-1 border border-[#ddd] px-3 text-sm outline-none focus:border-primary">
                                    <button type="submit" class="grid h-10 w-11 shrink-0 place-items-center bg-primary text-white transition hover:bg-red-700" aria-label="Search">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="relative overflow-hidden rounded-lg border border-[#eeeeee] bg-white pb-6 pt-9 shadow-sm">
                            <div class="pointer-events-none absolute left-1/2 top-0 h-5 w-[88px] -translate-x-1/2 rounded-b-full bg-[#fde8ea]"></div>
                            <div class="px-5">
                                <h3 class="font-heading text-lg font-bold uppercase tracking-wide text-ink">Categories</h3>
                                <ul class="mt-4 space-y-2">
                                    @forelse ($categories as $cat)
                                        <li>
                                            <a href="{{ route('blog', ['category' => $cat->slug]) }}" class="flex items-center gap-2 text-[15px] font-medium transition {{ request('category') === $cat->slug ? 'text-primary' : 'text-[#444] hover:text-primary' }}">
                                                <svg class="h-5 w-5 shrink-0 text-primary" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ $cat->name }}
                                            </a>
                                        </li>
                                    @empty
                                        <li class="text-sm text-gray-500">No categories.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="relative overflow-hidden rounded-lg border border-[#eeeeee] bg-white pb-6 pt-9 shadow-sm">
                            <div class="pointer-events-none absolute left-1/2 top-0 h-5 w-[88px] -translate-x-1/2 rounded-b-full bg-[#fde8ea]"></div>
                            <div class="px-5">
                                <h3 class="font-heading text-lg font-bold uppercase tracking-wide text-ink">Latest Posts</h3>
                                <ul class="mt-4 space-y-4">
                                    @forelse ($sidebarLatest as $sl)
                                        <li class="flex gap-3 border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                                            @if ($sl->featuredImageUrl())
                                                <img src="{{ $sl->featuredImageUrl() }}" alt="" class="h-16 w-20 shrink-0 rounded object-cover" loading="lazy" width="80" height="64">
                                            @else
                                                <div class="h-16 w-20 shrink-0 rounded bg-gray-200"></div>
                                            @endif
                                            <div class="min-w-0">
                                                <a href="{{ route('blog.show', $sl->slug) }}" class="font-heading text-sm font-semibold leading-snug text-ink line-clamp-2 hover:text-primary">{{ $sl->title }}</a>
                                                @if ($sl->published_at)
                                                    <p class="mt-1 text-xs uppercase tracking-wide text-[#888]">{{ $sl->published_at->format('M j, Y') }}</p>
                                                @endif
                                            </div>
                                        </li>
                                    @empty
                                        <li class="text-sm text-gray-500">No posts yet.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="relative overflow-hidden rounded-lg border border-[#eeeeee] bg-white pb-6 pt-9 shadow-sm">
                            <div class="pointer-events-none absolute left-1/2 top-0 h-5 w-[88px] -translate-x-1/2 rounded-b-full bg-[#fde8ea]"></div>
                            <div class="px-5">
                                <h3 class="font-heading text-lg font-bold uppercase tracking-wide text-ink">Tags</h3>
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @forelse ($tags as $tag)
                                        <a href="{{ route('blog', ['tag' => $tag->slug]) }}" class="inline-block rounded bg-primary px-3 py-1.5 font-heading text-xs font-semibold uppercase tracking-wide text-white transition hover:bg-red-700 {{ request('tag') === $tag->slug ? 'ring-2 ring-offset-2 ring-white' : '' }}">{{ $tag->name }}</a>
                                    @empty
                                        <span class="text-sm text-gray-500">No tags.</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                    </div>
                </aside>

            </div>
        </div>
    </div>
@endsection
