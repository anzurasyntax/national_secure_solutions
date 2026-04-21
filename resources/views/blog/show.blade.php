@extends('layouts.app')

@section('title', $post->title.' | '.config('app.name'))

@section('content')
    @include('sections.header', ['pageTitle' => $post->title])

    <article class="mx-auto max-w-[1170px] px-4 py-12 md:px-6 md:py-16">
        <div class="mx-auto max-w-3xl">
            @if ($post->published_at)
                <p class="mb-4 flex items-center gap-2 font-heading text-[11px] font-semibold uppercase tracking-[0.15em] text-[#888]">
                    <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                    {{ $post->published_at->format('F j, Y') }}
                </p>
            @endif

            <h1 class="font-heading text-3xl font-bold leading-tight text-ink md:text-4xl">{{ $post->title }}</h1>

            @if ($post->categories->isNotEmpty() || $post->tags->isNotEmpty())
                <div class="mt-4 flex flex-wrap gap-2 text-sm">
                    @foreach ($post->categories as $c)
                        <a href="{{ route('blog', ['category' => $c->slug]) }}" class="rounded-full bg-gray-100 px-3 py-1 text-[#444] transition hover:bg-primary hover:text-white">{{ $c->name }}</a>
                    @endforeach
                    @foreach ($post->tags as $t)
                        <a href="{{ route('blog', ['tag' => $t->slug]) }}" class="rounded-full bg-primary/10 px-3 py-1 text-primary transition hover:bg-primary hover:text-white">{{ $t->name }}</a>
                    @endforeach
                </div>
            @endif

            @if ($post->featuredImageUrl())
                <div class="mt-8 overflow-hidden rounded-xl border border-gray-200">
                    <img src="{{ $post->featuredImageUrl() }}" alt="" class="w-full object-cover" loading="eager">
                </div>
            @endif

            @if ($post->excerpt)
                <p class="mt-8 text-lg leading-relaxed text-[#555]">{{ $post->excerpt }}</p>
            @endif

            @if ($post->body)
                <div class="prose prose-lg mt-8 max-w-none text-[#444] [&_p]:mb-4 [&_ul]:mb-4 [&_ul]:list-disc [&_ul]:pl-6">
                    {!! nl2br(e($post->body)) !!}
                </div>
            @endif

            <div class="mt-12 border-t border-gray-200 pt-8">
                <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 font-heading text-sm font-semibold uppercase tracking-wide text-primary hover:underline">
                    <svg class="h-4 w-4 rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    Back to Latest Posts
                </a>
            </div>
        </div>

        @if ($recentPosts->isNotEmpty())
            <div class="mx-auto mt-16 max-w-3xl border-t border-gray-200 pt-12">
                <h2 class="font-heading text-xl font-bold text-ink">More posts</h2>
                <ul class="mt-6 space-y-3">
                    @foreach ($recentPosts as $rp)
                        <li>
                            <a href="{{ route('blog.show', $rp->slug) }}" class="text-lg font-medium text-primary hover:underline">{{ $rp->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </article>
@endsection
