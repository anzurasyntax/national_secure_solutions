<section class="relative h-[100svh] min-h-[560px] w-full md:h-screen">
    <div class="relative z-10 mx-auto flex h-full w-full justify-center">
        <div class="relative h-full w-full overflow-hidden">

            @forelse ($heroSlides as $index => $slide)
                <article class="fade-slide {{ $index === 0 ? 'active' : '' }} absolute inset-0" data-hero-slide>
                    <div class="h-full w-full bg-cover bg-center" style="background-image: url('{{ $slide->imageUrl() }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>

                    @if ($slide->tagline)
                        {{-- Slide layout with tagline + H1 (matches original slide 1) --}}
                        <div class="absolute inset-x-0 top-1/2 mx-auto w-[92%] -translate-y-[20%] px-4 text-white sm:w-[80%] sm:px-0 lg:w-[60%]" style="left:50%;transform:translateX(-50%) translateY(-20%);">
                            <p class="mb-3 font-heading text-sm font-bold uppercase leading-none tracking-[0.14em] text-primary sm:mb-4 sm:text-[20px] sm:tracking-widest lg:text-[25px]">{{ $slide->tagline }}</p>
                            <h1 class="max-w-[780px] font-heading text-2xl font-bold uppercase leading-tight sm:text-4xl lg:text-[47px] lg:leading-[1.15]">{{ $slide->headline }}</h1>
                            <a href="{{ $slide->button_url ?: '#' }}" class="mt-5 inline-block bg-primary px-5 py-3 font-heading text-xs font-bold uppercase tracking-wide text-white transition hover:bg-red-700 sm:mt-8 sm:px-8 sm:py-4 sm:text-sm">{{ $slide->button_label }}</a>
                        </div>
                    @else
                        {{-- Centered slide with H2 + subtitle --}}
                        <div class="absolute top-1/2 w-[92%] -translate-y-1/2 px-4 text-white sm:w-[80%] sm:px-0 lg:w-[60%]" style="left:50%;transform:translateX(-50%) translateY(-50%);">
                            <h2 class="max-w-3xl font-heading text-2xl font-bold uppercase leading-tight sm:text-4xl lg:text-[47px] lg:leading-[1.15]">{{ $slide->headline }}</h2>
                            @if ($slide->subtitle)
                                <p class="mt-3 font-heading text-base font-bold text-primary sm:mt-5 sm:text-xl">{{ $slide->subtitle }}</p>
                            @endif
                            <a href="{{ $slide->button_url ?: '#' }}" class="mt-5 inline-block bg-primary px-5 py-3 font-heading text-xs font-bold uppercase tracking-wide text-white transition hover:bg-red-700 sm:mt-8 sm:px-8 sm:py-4 sm:text-sm">{{ $slide->button_label }}</a>
                        </div>
                    @endif
                </article>
            @empty
                <article class="fade-slide active absolute inset-0" data-hero-slide>
                    <div class="flex h-full w-full items-center justify-center bg-ink">
                        <p class="font-heading text-lg uppercase tracking-wide text-white/70">Add hero slides in the admin panel.</p>
                    </div>
                </article>
            @endforelse

            @if ($heroSlides->isNotEmpty())
                {{-- Arrows inside a 90% wide centered wrapper --}}
                <div class="pointer-events-none absolute inset-x-0 top-1/2 z-20 w-[94%] -translate-y-1/2 sm:w-[82%] lg:w-[70%]" style="left:50%;transform:translateX(-50%) translateY(-50%);">
                    <button id="heroPrev" type="button" aria-label="Previous slide" class="pointer-events-auto absolute left-0 top-1/2 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full bg-[#f8b7b7]/70 text-white transition hover:bg-primary sm:h-14 sm:w-14 lg:h-20 lg:w-20">
                        <svg class="h-5 w-5 sm:h-7 sm:w-7 lg:h-10 lg:w-10" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button id="heroNext" type="button" aria-label="Next slide" class="pointer-events-auto absolute right-0 top-1/2 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full bg-[#f8b7b7]/70 text-white transition hover:bg-primary sm:h-14 sm:w-14 lg:h-20 lg:w-20">
                        <svg class="h-5 w-5 sm:h-7 sm:w-7 lg:h-10 lg:w-10" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                {{-- Dots --}}
                <div class="absolute bottom-4 left-1/2 z-20 flex -translate-x-1/2 gap-2 sm:bottom-6" id="heroDots">
                    @foreach ($heroSlides as $index => $slide)
                        <button type="button" class="dots-btn {{ $index === 0 ? 'active' : '' }}" data-dot="{{ $index }}" aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</section>
