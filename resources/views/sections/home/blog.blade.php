<section id="blog" class="relative overflow-hidden bg-white py-24 sm:py-32">
    
    <div class="relative z-10 mx-auto max-w-[1440px] px-5 sm:px-8 xl:px-12">
        
        <!-- Header -->
        <div class="mb-16 flex flex-col items-center justify-center text-center md:mb-20">
            <div class="mb-5 inline-flex items-center gap-3">
                <span class="h-px w-10 bg-primary"></span>
                <p class="font-heading text-xs font-bold uppercase tracking-[0.3em] text-primary">Insights & News</p>
                <span class="h-px w-10 bg-primary"></span>
            </div>
            
            <h2 class="mb-8 font-heading text-3xl font-bold uppercase tracking-tight text-gray-900 sm:text-4xl md:text-5xl">
                Latest Articles
            </h2>
            
            <a href="{{ route('blog') }}" class="group inline-flex items-center gap-2 font-heading text-xs font-bold uppercase tracking-widest text-gray-500 transition hover:text-primary">
                View all posts
                <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3 md:gap-8 lg:gap-12">
            @forelse (($blogPosts ?? collect()) as $blogPost)
                <article class="group relative flex flex-col overflow-hidden rounded-2xl bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)]">
                    
                    @if ($blogPost->featuredImageUrl())
                        <a href="{{ route('blog.show', $blogPost->slug) }}" class="relative block aspect-[16/10] overflow-hidden">
                            <img src="{{ $blogPost->featuredImageUrl() }}" alt="" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/40 to-transparent"></div>
                        </a>
                    @else
                        <a href="{{ route('blog.show', $blogPost->slug) }}" class="relative block aspect-[16/10] overflow-hidden bg-gray-100">
                            <div class="absolute inset-0 grid place-items-center text-gray-300">
                                <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        </a>
                    @endif
                    
                    <div class="flex flex-1 flex-col p-8 sm:p-10">
                        @if ($blogPost->published_at)
                            <time datetime="{{ $blogPost->published_at->toDateString() }}" class="mb-4 block font-heading text-[10px] font-bold uppercase tracking-[0.2em] text-primary">
                                {{ $blogPost->published_at->format('F j, Y') }}
                            </time>
                        @endif
                        
                        <h3 class="mb-4 font-heading text-xl font-bold uppercase tracking-wide text-gray-900 sm:text-2xl">
                            <a href="{{ route('blog.show', $blogPost->slug) }}" class="transition-colors hover:text-primary">
                                {{ $blogPost->title }}
                            </a>
                        </h3>
                        
                        @if ($blogPost->excerpt)
                            <p class="mb-8 font-sans text-sm leading-relaxed text-gray-600 sm:text-base">
                                {{ \Illuminate\Support\Str::limit($blogPost->excerpt, 120) }}
                            </p>
                        @endif
                        
                        <div class="mt-auto pt-4">
                            <a href="{{ route('blog.show', $blogPost->slug) }}" class="inline-flex items-center gap-2 font-heading text-xs font-bold uppercase tracking-widest text-gray-900 transition-colors hover:text-primary">
                                Read More
                                <svg class="h-4 w-4 text-primary transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                    
                </article>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-gray-300 bg-gray-50 p-12 text-center text-gray-500">
                    <p class="font-sans text-sm font-medium uppercase tracking-widest">No articles published yet.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>
