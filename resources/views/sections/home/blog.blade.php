<section id="blog" class="mx-auto max-w-[80%] pb-40 px-4 py-16 scroll-mt-24">
    <!-- Header -->
    <div class="mb-12 text-center">
        <p class="font-heading text-sm font-semibold uppercase tracking-[3px] text-[#cc0000]">Our Blog</p>
        <h2 class="font-heading text-[38px] font-bold text-[#1c1c25]">Latest Articles</h2>
        <span class="mx-auto mt-4 block h-[3px] w-20 bg-[#cc0000]"></span>
        <p class="mt-6">
            <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 font-heading text-lg font-semibold uppercase tracking-wide text-[#cc0000] underline decoration-2 underline-offset-4 hover:no-underline">
                View all posts
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </p>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

        @forelse (($blogPosts ?? collect()) as $blogPost)
            <article class="service-card overflow-hidden bg-white shadow-[0_10px_30px_rgba(0,0,0,0.08)]">
                @if ($blogPost->featuredImageUrl())
                    <a href="{{ route('blog.show', $blogPost->slug) }}" class="block aspect-[16/10] overflow-hidden bg-gray-100">
                        <img src="{{ $blogPost->featuredImageUrl() }}" alt="" class="h-full w-full object-cover transition hover:scale-[1.03]" loading="lazy">
                    </a>
                @endif
                <div class="p-6">
                    @if ($blogPost->published_at)
                        <p class="mb-2 font-heading text-[11px] font-semibold uppercase tracking-wider text-[#888]">
                            {{ strtoupper($blogPost->published_at->format('F j, Y')) }}
                        </p>
                    @endif
                    <h3 class="mb-3 font-heading text-2xl font-bold leading-snug text-[#1c1c25] md:text-[28px]">
                        <a href="{{ route('blog.show', $blogPost->slug) }}" class="hover:text-[#cc0000]">{{ $blogPost->title }}</a>
                    </h3>
                    @if ($blogPost->excerpt)
                        <p class="mb-4 text-lg leading-relaxed text-gray-500">{{ \Illuminate\Support\Str::limit($blogPost->excerpt, 140) }}</p>
                    @endif
                    <a href="{{ route('blog.show', $blogPost->slug) }}" class="flex items-center gap-1 font-heading text-lg font-semibold text-[#cc0000] underline hover:no-underline">
                        Read More
                    </a>
                </div>
            </article>
        @empty
            <div class="md:col-span-3 rounded-xl border border-dashed border-gray-300 bg-gray-50 px-8 py-12 text-center text-gray-600">
                <p class="font-semibold text-[#1c1c25]">No articles published yet.</p>
                <p class="mt-2 text-sm">Posts added in the admin panel will appear here.</p>
                <a href="{{ route('blog') }}" class="mt-4 inline-block font-semibold text-[#cc0000] hover:underline">Open blog page</a>
            </div>
        @endforelse

    </div>
</section>
