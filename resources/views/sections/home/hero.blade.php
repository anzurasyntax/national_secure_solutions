<section class="relative h-screen w-full">
    <div class="relative z-10 mx-auto flex h-full w-full justify-center">
        <div class="relative h-full w-full overflow-hidden">

            @forelse ($heroSlides as $index => $slide)
                <article class="fade-slide {{ $index === 0 ? 'active' : '' }} absolute inset-0" data-hero-slide>
                    <div class="h-full w-full bg-cover bg-center" style="background-image: url('{{ $slide->imageUrl() }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>

                    @if ($slide->tagline)
                        {{-- Slide layout with tagline + H1 (matches original slide 1) --}}
                        <div class="absolute inset-x-0 top-1/2 mx-auto w-[60%] -translate-y-[20%] px-0 text-white" style="left:50%;transform:translateX(-50%) translateY(-20%);">
                            <p class="mb-4 font-heading text-[20px] font-bold uppercase leading-none tracking-widest text-primary sm:text-[28px]">{{ $slide->tagline }}</p>
                            <h1 class="max-w-[780px] font-heading text-3xl font-bold uppercase leading-tight sm:text-5xl lg:text-[50px] lg:leading-[1.15]">{{ $slide->headline }}</h1>
                            <a href="{{ $slide->button_url ?: '#' }}" class="mt-8 inline-block bg-primary px-8 py-4 font-heading text-sm font-bold uppercase tracking-wide text-white transition hover:bg-red-700">{{ $slide->button_label }}</a>
                        </div>
                    @else
                        {{-- Centered slide with H2 + subtitle --}}
                        <div class="absolute top-1/2 w-[60%] -translate-y-1/2 px-0 text-white" style="left:50%;transform:translateX(-50%) translateY(-50%);">
                            <h2 class="max-w-3xl font-heading text-3xl font-bold uppercase leading-tight sm:text-5xl lg:text-[50px] lg:leading-[1.15]">{{ $slide->headline }}</h2>
                            @if ($slide->subtitle)
                                <p class="mt-5 font-heading text-xl font-bold text-primary">{{ $slide->subtitle }}</p>
                            @endif
                            <a href="{{ $slide->button_url ?: '#' }}" class="mt-8 inline-block bg-primary px-8 py-4 font-heading text-sm font-bold uppercase tracking-wide text-white transition hover:bg-red-700">{{ $slide->button_label }}</a>
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
                <div class="pointer-events-none absolute inset-x-0 top-1/2 z-20 -translate-y-1/2" style="left:50%;transform:translateX(-50%) translateY(-50%);width:70%;">
                    <button id="heroPrev" type="button" class="pointer-events-auto absolute left-0 top-1/2 grid h-20 w-20 -translate-y-1/2 place-items-center rounded-full bg-[#f8b7b7]/70 text-white transition hover:bg-primary">
                        <span class="text-2xl font-bold leading-none">‹</span>
                    </button>
                    <button id="heroNext" type="button" class="pointer-events-auto absolute right-0 top-1/2 grid h-20 w-20 -translate-y-1/2 place-items-center rounded-full bg-[#f8b7b7]/70 text-white transition hover:bg-primary">
                        <span class="text-2xl font-bold leading-none">›</span>
                    </button>
                </div>

                {{-- Dots --}}
                <div class="absolute bottom-6 left-1/2 z-20 flex -translate-x-1/2 gap-2" id="heroDots">
                    @foreach ($heroSlides as $index => $slide)
                        <button type="button" class="dots-btn {{ $index === 0 ? 'active' : '' }}" data-dot="{{ $index }}" aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</section>
