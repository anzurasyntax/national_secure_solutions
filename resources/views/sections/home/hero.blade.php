<section class="relative h-screen w-full">
    <div class="relative z-10 mx-auto flex h-full w-full justify-center">
        <div class="relative h-full w-full overflow-hidden">

            {{-- Slide 1 --}}
            <article class="fade-slide active absolute inset-0" data-hero-slide>
                {{-- Full-width background image --}}
                <div class="h-full w-full bg-cover bg-center" style="background-image: url('{{ asset('img/slider1.png') }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>
                {{-- Content constrained to 90% --}}
                <div class="absolute inset-x-0 top-1/2 mx-auto w-[60%] -translate-y-[20%] px-0 text-white" style="left:50%;transform:translateX(-50%) translateY(-20%);">
                    <p class="mb-4 font-heading text-[20px] font-bold uppercase leading-none tracking-widest text-primary sm:text-[28px]">Securing is our best part of life</p>
                    <h1 class="max-w-[780px] font-heading text-3xl font-bold uppercase leading-tight sm:text-5xl lg:text-[50px] lg:leading-[1.15]">THE BALANCE BETWEEN FREEDOM AND SECURITY IS A DELICATE ONE</h1>
                    <a href="#" class="mt-8 inline-block bg-primary px-8 py-4 font-heading text-sm font-bold uppercase tracking-wide text-white transition hover:bg-red-700">Get Inquiry</a>
                </div>
            </article>

            {{-- Slide 2 --}}
            <article class="fade-slide absolute inset-0" data-hero-slide>
                <div class="h-full w-full bg-cover bg-center" style="background-image: url('{{ asset('img/slider1.png') }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>
                <div class="absolute top-1/2 w-[60%] -translate-y-1/2 px-0 text-white" style="left:50%;transform:translateX(-50%) translateY(-50%);">
                    <h2 class="max-w-3xl font-heading text-3xl font-bold uppercase leading-tight sm:text-5xl lg:text-[50px] lg:leading-[1.15]">SECURITY IS NOT THE MEANING OF LIFE, GREAT OPPORTUNITIES ARE WORTH THE RISK</h2>
                    <p class="mt-5 font-heading text-xl font-bold text-primary">Welcome to Trans-World Security Guards</p>
                    <a href="#" class="mt-8 inline-block bg-primary px-8 py-4 font-heading text-sm font-bold uppercase tracking-wide text-white transition hover:bg-red-700">Get Inquiry</a>
                </div>
            </article>

            {{-- Slide 3 --}}
            <article class="fade-slide absolute inset-0" data-hero-slide>
                <div class="h-full w-full bg-cover bg-center" style="background-image: url('{{ asset('img/slider1.png') }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>
                <div class="absolute top-1/2 w-[60%] -translate-y-1/2 px-0 text-white" style="left:50%;transform:translateX(-50%) translateY(-50%);">
                    <h2 class="max-w-3xl font-heading text-3xl font-bold uppercase leading-tight sm:text-5xl lg:text-[50px] lg:leading-[1.15]">BEING SECURITY IS NOT A PRODUCT, BUT IT IS A PROCESS</h2>
                    <p class="mt-5 font-heading text-xl font-bold text-primary">Protection, Defense, &amp; Access Control</p>
                    <a href="#" class="mt-8 inline-block bg-primary px-8 py-4 font-heading text-sm font-bold uppercase tracking-wide text-white transition hover:bg-red-700">Get Inquiry</a>
                </div>
            </article>

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
                <button type="button" class="dots-btn active" data-dot="0" aria-label="Slide 1"></button>
                <button type="button" class="dots-btn" data-dot="1" aria-label="Slide 2"></button>
                <button type="button" class="dots-btn" data-dot="2" aria-label="Slide 3"></button>
            </div>

        </div>
    </div>
</section>
