@php
    $items = isset($testimonials) ? collect($testimonials) : collect();
@endphp

<section class="relative w-full overflow-hidden py-20 text-white"
         style="background-image: url('{{ asset('img/testimonial_bg.png') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative z-10 mx-auto max-w-[92%] px-4 sm:max-w-[88%] lg:max-w-[80%]">

        <div class="mb-10 flex items-start justify-between gap-4">
            <div class="flex-1 text-center">
                <p class="font-heading text-sm font-bold uppercase tracking-[3px] text-primary">Testimonials</p>
                <h2 class="font-heading text-3xl font-bold text-white sm:text-[42px]">What Say Clients</h2>
                <span class="mx-auto mt-4 block h-[3px] w-16 bg-primary"></span>
            </div>
            @if ($items->count() > 1)
                <div class="flex shrink-0 items-center gap-3 pt-2">
                    <button id="testimonialPrev" type="button"
                            class="text-primary transition-opacity hover:opacity-60">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-label="Previous">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button id="testimonialNext" type="button"
                            class="text-primary transition-opacity hover:opacity-60">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-label="Next">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <div class="relative mx-auto max-w-full lg:max-w-[80%]">

            @if ($items->isEmpty())
                <p class="rounded-xl bg-white/10 px-8 py-12 text-center text-white/80">No testimonials yet. Add them under Admin → Home page → Testimonials.</p>
            @else
                <style>
                    [data-testimonial-slide]:not(.active) { display: none !important; }
                </style>

                <div id="tSlides" class="relative">
                    @foreach ($items as $index => $t)
                        <div class="t-slide {{ $index === 0 ? 'active' : '' }} relative rounded-xl bg-white px-5 py-8 text-center shadow-2xl transition-all duration-500 sm:px-10 sm:py-9 lg:px-16 lg:py-10"
                             data-testimonial-slide>
                            <div class="absolute -left-4 top-8 sm:-left-6 sm:top-1/2 sm:-translate-y-1/2 lg:-left-9">
                                <div class="h-12 w-12 overflow-hidden rounded-full border-4 border-yellow-400 shadow-lg sm:h-14 sm:w-14 lg:h-[72px] lg:w-[72px]">
                                    <img src="{{ $t->avatarUrl() }}" alt="{{ $t->name }}" class="h-full w-full object-cover">
                                </div>
                            </div>
                            <div class="pointer-events-none absolute bottom-4 right-4 select-none font-serif text-5xl leading-none text-gray-200 sm:bottom-6 sm:right-8 sm:text-[80px]">
                                <img src="{{ asset('img/testimonial.png') }}" alt="" style="opacity: 0.2;">
                            </div>

                            <p class="mx-auto max-w-3xl text-base leading-8 text-gray-500 sm:text-lg sm:leading-9 lg:text-[20px] lg:leading-[1.9]">
                                {{ $t->body }}
                            </p>
                            <div class="mt-6 flex justify-center gap-1 text-3xl text-yellow-400 sm:text-4xl" aria-hidden="true">
                                {{ $t->starsDisplay() }}
                            </div>
                            <h3 class="mt-4 font-heading text-2xl font-extrabold uppercase text-[#1c1c25] sm:text-[28px]">{{ $t->name }}</h3>
                            <p class="mt-1 text-sm font-semibold text-gray-400 sm:text-base">{{ $t->role }}</p>
                        </div>
                    @endforeach
                </div>

            @endif
        </div>

        @if ($items->count() > 1)
            <div class="relative z-10 mt-10 flex justify-center gap-2" id="testimonialDots">
                @foreach ($items as $index => $t)
                    <button type="button" class="dots-btn {{ $index === 0 ? 'active' : '' }}" data-tdot="{{ $index }}" aria-label="Testimonial {{ $index + 1 }}"></button>
                @endforeach
            </div>
        @endif
    </div>
</section>
