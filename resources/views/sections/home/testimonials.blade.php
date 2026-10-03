@php
    $items = isset($testimonials) ? collect($testimonials) : collect();
@endphp

<section class="relative overflow-hidden bg-gray-50 py-24 sm:py-32">
    {{-- Decorative subtle shapes --}}
    <div class="absolute -right-40 top-0 h-96 w-96 rounded-full bg-primary/5 blur-3xl"></div>
    <div class="absolute -left-40 bottom-0 h-96 w-96 rounded-full bg-blue-900/5 blur-3xl"></div>
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808008_1px,transparent_1px),linear-gradient(to_bottom,#80808008_1px,transparent_1px)] bg-[size:24px_24px]"></div>

    <div class="relative z-10 mx-auto max-w-[1440px] px-5 sm:px-8 xl:px-12">

        <div class="mb-16 flex flex-col items-center justify-center text-center md:mb-20">
            <div class="mb-5 inline-flex items-center gap-3">
                <span class="h-px w-10 bg-primary"></span>
                <p class="font-heading text-xs font-bold uppercase tracking-[0.3em] text-primary">Testimonials</p>
                <span class="h-px w-10 bg-primary"></span>
            </div>
            <h2 class="font-heading text-3xl font-bold uppercase tracking-tight text-gray-900 sm:text-4xl md:text-5xl">
                What Our Clients Say
            </h2>
        </div>

        <div class="relative mx-auto max-w-4xl">

            @if ($items->isEmpty())
                <div class="rounded-2xl border border-dashed border-gray-300 p-12 text-center text-gray-500">
                    <p class="font-sans text-sm font-medium uppercase tracking-widest">No testimonials yet. Add them under Admin → Home page → Testimonials.</p>
                </div>
            @else
                <style>
                    [data-testimonial-slide]:not(.active) { display: none !important; }
                </style>

                <div id="tSlides" class="relative">
                    @foreach ($items as $index => $t)
                        <div class="t-slide {{ $index === 0 ? 'active' : '' }} relative rounded-2xl bg-white p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] ring-1 ring-gray-900/5 transition-all duration-500 sm:p-12 lg:p-16"
                             data-testimonial-slide>
                             
                            {{-- Large quote icon --}}
                            <div class="absolute -top-6 left-1/2 -translate-x-1/2 grid h-12 w-12 place-items-center rounded-xl bg-primary text-white shadow-lg sm:left-12 sm:translate-x-0">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                            </div>

                            <p class="mx-auto mt-6 text-center font-sans text-base leading-relaxed text-gray-600 sm:text-lg sm:leading-loose">
                                "{{ $t->body }}"
                            </p>
                            
                            <div class="mt-10 flex flex-col items-center justify-center gap-4 border-t border-gray-100 pt-8 sm:flex-row sm:justify-between sm:text-left">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $t->avatarUrl() }}" alt="{{ $t->name }}" class="h-14 w-14 rounded-full object-cover ring-2 ring-primary/20">
                                    <div>
                                        <h3 class="font-heading text-lg font-bold uppercase text-gray-900">{{ $t->name }}</h3>
                                        <p class="font-sans text-sm text-gray-500">{{ $t->role }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-1 text-yellow-400">
                                    {{ $t->starsDisplay() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($items->count() > 1)
                    <div class="mt-10 flex items-center justify-between">
                        <div class="flex gap-2" id="testimonialDots">
                            @foreach ($items as $index => $t)
                                <button type="button" class="dots-btn h-2 w-2 rounded-full bg-gray-300 transition-all duration-300 hover:bg-gray-400 [&.active]:w-8 [&.active]:bg-primary {{ $index === 0 ? 'active' : '' }}" data-tdot="{{ $index }}" aria-label="Testimonial {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                        
                        <div class="flex gap-3">
                            <button id="testimonialPrev" type="button" class="grid h-10 w-10 place-items-center rounded-full border border-gray-200 bg-white text-gray-400 transition hover:border-primary hover:bg-primary hover:text-white">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button id="testimonialNext" type="button" class="grid h-10 w-10 place-items-center rounded-full border border-gray-200 bg-white text-gray-400 transition hover:border-primary hover:bg-primary hover:text-white">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                @endif
                
            @endif
        </div>
    </div>
</section>
