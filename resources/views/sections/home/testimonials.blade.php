@php
    $items = isset($testimonials) ? collect($testimonials) : collect();
@endphp

<section class="relative w-full overflow-hidden py-20 text-white"
         style="background-image: url('{{ asset('img/testimonial_bg.png') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative z-10 mx-auto max-w-[80%] px-4">

        <div class="mb-10 flex items-start justify-between">
            <div class="flex-1 text-center">
                <p class="font-heading text-sm font-bold uppercase tracking-[3px] text-primary">Testimonials</p>
                <h2 class="font-heading text-[42px] font-bold text-white">What Say Clients</h2>
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

        <div class="relative mx-auto max-w-[80%]">

            @if ($items->isEmpty())
                <p class="rounded-xl bg-white/10 px-8 py-12 text-center text-white/80">No testimonials yet. Add them under Admin → Home page → Testimonials.</p>
            @else
                <style>
                    [data-testimonial-slide]:not(.active) { display: none !important; }
                </style>

                <div id="tSlides" class="relative">
                    @foreach ($items as $index => $t)
                        <div class="t-slide {{ $index === 0 ? 'active' : '' }} relative rounded-xl bg-white px-16 py-10 text-center shadow-2xl transition-all duration-500"
                             data-testimonial-slide>
                            <div class="absolute -left-9 top-1/2 -translate-y-1/2">
                                <div class="h-[72px] w-[72px] rounded-full border-4 border-yellow-400 overflow-hidden shadow-lg">
                                    <img src="{{ $t->avatarUrl() }}" alt="{{ $t->name }}" class="h-full w-full object-cover">
                                </div>
                            </div>
                            <div class="absolute bottom-6 right-8 text-[80px] font-serif leading-none text-gray-200 select-none pointer-events-none">
                                <img src="{{ asset('img/testimonial.png') }}" alt="" style="opacity: 0.2;">
                            </div>

                            <p class="mx-auto max-w-3xl text-[20px] leading-[1.9] text-gray-500">
                                {{ $t->body }}
                            </p>
                            <div class="mt-6 flex justify-center gap-1 text-yellow-400 text-4xl" aria-hidden="true">
                                {{ $t->starsDisplay() }}
                            </div>
                            <h3 class="mt-4 font-heading text-[28px] font-extrabold uppercase text-[#1c1c25]">{{ $t->name }}</h3>
                            <p class="mt-1 text-md font-semibold text-gray-400">{{ $t->role }}</p>
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
