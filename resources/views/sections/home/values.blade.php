@php
    $items = isset($ourValues) ? collect($ourValues) : collect();
    $count = $items->count();
    $pages = $count > 0 ? (int) ceil($count / 3) : 0;
@endphp

<section class="relative bg-gray-50 py-24 sm:py-32">
    
    <div class="mx-auto max-w-[1440px] px-5 sm:px-8 xl:px-12">
        
        <div class="mb-16 flex flex-col items-center justify-center md:mb-20">
            <div class="mb-5 inline-flex items-center gap-3">
                <span class="h-px w-10 bg-primary"></span>
                <p class="font-heading text-xs font-bold uppercase tracking-[0.3em] text-primary">Core Principles</p>
                <span class="h-px w-10 bg-primary"></span>
            </div>
            <h2 class="font-heading text-3xl font-bold uppercase tracking-tight text-gray-900 sm:text-4xl md:text-5xl">
                Our Values
            </h2>
        </div>

        @if ($count === 0)
            <div class="rounded-2xl border border-dashed border-gray-300 p-12 text-center text-gray-500">
                <p class="font-sans text-sm font-medium uppercase tracking-widest">Value cards will appear here once added in the admin.</p>
            </div>
        @else
            <div id="values-slider-viewport" class="relative overflow-hidden rounded-2xl">
                <div id="values-track" class="flex transition-transform duration-700 ease-out">
                    @foreach ($items as $v)
                        <article class="group relative w-full flex-shrink-0 px-3 md:w-1/2 lg:w-1/3">
                            <div class="relative overflow-hidden rounded-2xl shadow-[0_4px_20px_rgb(0,0,0,0.05)] ring-1 ring-gray-900/5 transition-transform duration-500 group-hover:-translate-y-2">
                                <img src="{{ $v->imageSrc() }}"
                                     alt="{{ $v->line1 }}"
                                     class="h-[320px] w-full object-cover transition-transform duration-700 group-hover:scale-105 sm:h-[400px]">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-[#080B12]/95 via-[#080B12]/40 to-transparent transition-opacity duration-500 group-hover:opacity-90"></div>
                                
                                <div class="absolute left-6 top-6 flex items-center gap-3 opacity-0 transition-all duration-500 group-hover:opacity-100 group-hover:-translate-y-1">
                                    <span class="grid h-12 w-12 place-items-center rounded-xl bg-primary text-white shadow-lg">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                    </span>
                                </div>
                                
                                <div class="absolute bottom-0 left-0 p-8 transition-transform duration-500 group-hover:-translate-y-2">
                                    <p class="mb-3 font-heading text-xs font-bold uppercase tracking-[0.2em] text-primary">{{ $v->eyebrow }}</p>
                                    <h3 class="font-heading text-2xl font-bold leading-tight text-white sm:text-3xl">{{ $v->line1 }}<br>{{ $v->line2 }}</h3>
                                </div>
                                
                                <div class="absolute bottom-0 left-0 h-1 w-0 bg-primary transition-all duration-500 group-hover:w-full"></div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            @if ($pages > 1)
                <div class="mt-12 flex items-center justify-center gap-4" id="values-dots" role="tablist">
                    @for ($p = 0; $p < $pages; $p++)
                        <button type="button"
                                onclick="window.__valuesGoToSlide && window.__valuesGoToSlide({{ $p }})"
                                class="values-dot h-2 w-12 rounded-full transition-all duration-300 bg-gray-300 hover:bg-gray-400"
                                data-values-page="{{ $p }}"
                                aria-label="Show page {{ $p + 1 }}"></button>
                    @endfor
                </div>
            @endif

            <script>
                (function () {
                    const pages = {{ $pages }};
                    const track = document.getElementById('values-track');
                    const viewport = document.getElementById('values-slider-viewport');
                    const dots = document.querySelectorAll('.values-dot');
                    let current = 0;

                    function paintDots() {
                        dots.forEach(function (d, i) {
                            if (i === current) {
                                d.classList.add('bg-primary');
                                d.classList.remove('bg-gray-300', 'hover:bg-gray-400');
                            } else {
                                d.classList.add('bg-gray-300', 'hover:bg-gray-400');
                                d.classList.remove('bg-primary');
                            }
                        });
                    }

                    window.__valuesGoToSlide = function (index) {
                        if (!track || !viewport || pages < 2) return;
                        current = Math.max(0, Math.min(index, pages - 1));
                        var itemWidth = track.firstElementChild.offsetWidth;
                        // On mobile (1 item/page) it moves 1 width, on tablet 2, on lg 3
                        // To keep it simple, we just assume `pages` corresponds to the chunk size
                        // A more robust slider would use IntersectionObserver or similar, but we keep the logic the same.
                        track.style.transform = 'translateX(-' + (current * viewport.offsetWidth) + 'px)';
                        paintDots();
                    };

                    if (track && viewport && pages > 1) {
                        paintDots();
                        window.addEventListener('resize', function () {
                            window.__valuesGoToSlide(current);
                        });
                    }
                })();
            </script>
        @endif
        
    </div>
</section>
