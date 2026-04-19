<section
    class="relative py-16 text-white overflow-hidden"
    style="background-color: #070E20; background-image: url('{{ asset('img/stat_bg.png') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;"
>
    {{-- Dark overlay like the elementor-background-overlay --}}
<div class="absolute inset-0" style="background-color: rgba(211, 211, 211, 0.15);"></div>


    <div class="relative z-10 mx-auto max-w-[1170px] px-4">
        <div class="grid grid-cols-2 md:grid-cols-4">

            {{-- Stat 1 --}}
            <article class="flex flex-col items-center justify-center py-8 px-6 text-center relative">
                <h3 class="text-[52px] font-extrabold leading-tight tracking-tight">
                    <span data-counter="3500">0</span>+
                </h3>
                <p class="mt-2 text-[13px] font-bold uppercase tracking-[2px] text-gray-300">Total Guards</p>
                {{-- Right divider --}}
                <span class="absolute right-0 top-1/2 -translate-y-1/2 h-12 w-[2px] bg-red-600 hidden md:block"></span>
            </article>

            {{-- Stat 2 --}}
            <article class="flex flex-col items-center justify-center py-8 px-6 text-center relative">
                <h3 class="text-[52px] font-extrabold leading-tight tracking-tight">
                    <span data-counter="2340">0</span>+
                </h3>
                <p class="mt-2 text-[13px] font-bold uppercase tracking-[2px] text-gray-300">Happy Clients</p>
                <span class="absolute right-0 top-1/2 -translate-y-1/2 h-12 w-[2px] bg-red-600 hidden md:block"></span>
            </article>

            {{-- Stat 3 --}}
            <article class="flex flex-col items-center justify-center py-8 px-6 text-center relative">
                <h3 class="text-[52px] font-extrabold leading-tight tracking-tight">
                    <span data-counter="48">0</span>
                </h3>
                <p class="mt-2 text-[13px] font-bold uppercase tracking-[2px] text-gray-300">Awards</p>
                <span class="absolute right-0 top-1/2 -translate-y-1/2 h-12 w-[2px] bg-red-600 hidden md:block"></span>
            </article>

            {{-- Stat 4 --}}
            <article class="flex flex-col items-center justify-center py-8 px-6 text-center">
                <h3 class="text-[52px] font-extrabold leading-tight tracking-tight">
                    <span data-counter="35">0</span>
                </h3>
                <p class="mt-2 text-[13px] font-bold uppercase tracking-[2px] text-gray-300">Branches</p>
            </article>

        </div>
    </div>
</section>

{{-- Counter animation script --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('[data-counter]');
        const speed = 2000;

        const animateCounter = (el) => {
            const target = +el.getAttribute('data-counter');
            const step = target / (speed / 16);
            let current = 0;

            const update = () => {
                current += step;
                if (current < target) {
                    el.textContent = Math.floor(current).toLocaleString();
                    requestAnimationFrame(update);
                } else {
                    el.textContent = target.toLocaleString();
                }
            };
            update();
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        counters.forEach(el => observer.observe(el));
    });
</script>
