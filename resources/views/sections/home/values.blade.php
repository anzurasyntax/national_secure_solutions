@php
    $items = isset($ourValues) ? collect($ourValues) : collect();
    $count = $items->count();
    $pages = $count > 0 ? (int) ceil($count / 3) : 0;
@endphp

<section class="mx-auto max-w-[80%] px-4 py-16">

    <div class="mb-10 text-center">
        <p class="font-heading text-sm font-semibold uppercase tracking-[3px] text-primary">Values</p>
        <h2 class="font-heading text-[38px] font-bold text-[#1c1c25]">OUR VALUES</h2>
        <span class="mx-auto mt-4 block h-[3px] w-16 bg-primary"></span>
    </div>

    @if ($count === 0)
        <p class="text-center text-sm text-gray-500">Value cards will appear here once added in the admin.</p>
    @else
        <div id="values-slider-viewport" class="relative overflow-hidden">
            <div id="values-track" class="flex gap-6 transition-transform duration-500 ease-in-out">
                @foreach ($items as $v)
                    <article class="group relative min-w-[calc(33.333%-1rem)] flex-shrink-0 cursor-pointer overflow-hidden rounded-xl">
                        <img src="{{ $v->imageSrc() }}"
                             alt="{{ $v->line1 }}"
                             class="h-[300px] w-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/55 backdrop-blur-[1px] transition-all duration-400 group-hover:bg-black/75 group-hover:backdrop-blur-0"></div>
                        <div class="absolute left-5 top-5 flex gap-2">
                            <span class="flex h-14 w-14 items-center justify-center rounded-md bg-primary text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/></svg>
                            </span>
                            <span class="flex h-14 w-14 items-center justify-center rounded-md bg-primary text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <p class="mb-1 text-lg font-bold uppercase tracking-[2px] text-white/70">{{ $v->eyebrow }}</p>
                            <h3 class="font-heading text-[28px] font-bold leading-snug text-white">{{ $v->line1 }}<br>{{ $v->line2 }}</h3>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        @if ($pages > 1)
            <div class="mt-8 flex items-center justify-center gap-3" id="values-dots" role="tablist" aria-label="Values pages">
                @for ($p = 0; $p < $pages; $p++)
                    <button type="button"
                            onclick="window.__valuesGoToSlide && window.__valuesGoToSlide({{ $p }})"
                            class="values-dot h-[6px] w-10 rounded-full transition-all duration-300 bg-gray-300"
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
                            d.classList.add('bg-primary', 'w-10');
                            d.classList.remove('bg-gray-300');
                        } else {
                            d.classList.add('bg-gray-300');
                            d.classList.remove('bg-primary', 'w-10');
                        }
                    });
                }

                window.__valuesGoToSlide = function (index) {
                    if (!track || !viewport || pages < 2) return;
                    current = Math.max(0, Math.min(index, pages - 1));
                    var w = viewport.offsetWidth;
                    track.style.transform = 'translateX(-' + (current * w) + 'px)';
                    paintDots();
                };

                if (track && viewport && pages > 1) {
                    paintDots();
                    window.addEventListener('resize', function () {
                        window.__valuesGoToSlide(current);
                    });
                    window.__valuesGoToSlide(0);
                }
            })();
        </script>
    @endif

</section>
