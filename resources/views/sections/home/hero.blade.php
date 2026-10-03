<section class="relative min-h-[850px] overflow-hidden bg-[#080B12] text-white lg:min-h-[950px]">

    {{-- Subtle background decoration --}}
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -right-40 -top-40 h-[500px] w-[500px] rounded-full bg-primary/10 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 h-[450px] w-[450px] rounded-full bg-primary/5 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.06),transparent_35%)]"></div>
    </div>

    <div class="relative z-10 mx-auto flex min-h-[850px] w-full max-w-[1600px] flex-col justify-start px-5 pb-16 pt-[200px] sm:px-8 lg:min-h-[950px] lg:px-12 lg:pt-[240px] xl:px-16">



        @forelse ($heroSlides as $index => $slide)

            <article
                data-hero-slide
                data-slide-index="{{ $index }}"
                class="absolute inset-0 flex flex-col justify-start pt-[180px] lg:pt-[240px] opacity-0 transition-all duration-700 ease-out pointer-events-none {{ $index === 0 ? 'active opacity-100 pointer-events-auto' : '' }}"
            >

                {{-- Background image --}}
                <div class="absolute inset-0">
                    <img
                        src="{{ $slide->imageUrl() }}"
                        alt="{{ $slide->headline }}"
                        class="h-full w-full object-cover opacity-25"
                    >

                    <div class="absolute inset-0 bg-[#080B12]/80"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-[#080B12] via-[#080B12]/95 to-[#080B12]/55"></div>
                </div>

                {{-- Content --}}
                <div class="relative mx-auto grid w-full max-w-[1600px] grid-cols-1 gap-12 px-5 sm:px-8 lg:grid-cols-[1.05fr_0.95fr] lg:gap-16 lg:px-12 xl:gap-24 xl:px-16">

                    {{-- LEFT --}}
                    <div class="max-w-3xl">

                        {{-- Small label --}}
                        <div class="mb-10 flex items-center gap-4">
                            <span class="h-px w-12 bg-primary"></span>

                            <span class="font-heading text-[12px] font-bold uppercase tracking-[0.3em] text-primary sm:text-[13px]">
                                {{ $slide->tagline ?: 'Professional Security Solutions' }}
                            </span>
                        </div>

                        {{-- Main heading --}}
                        <h1 class="mb-10 font-heading text-4xl font-bold uppercase leading-[0.95] tracking-tight text-white sm:text-5xl md:text-6xl lg:text-[64px] xl:text-[76px]">

                            {{ $slide->headline }}

                        </h1>

                        {{-- Subtitle --}}
                        @if ($slide->subtitle)
                            <p class="mb-12 max-w-2xl font-sans text-base leading-relaxed text-white/65 sm:text-lg sm:leading-loose">
                                {{ $slide->subtitle }}
                            </p>
                        @else
                            <p class="mb-12 max-w-2xl font-sans text-base leading-relaxed text-white/65 sm:text-lg sm:leading-loose">
                                Professional protection, advanced security systems and dependable solutions designed around your safety.
                            </p>
                        @endif

                        {{-- Buttons --}}
                        <div class="flex flex-wrap items-center gap-4">

                            <a
                                href="{{ $slide->button_url ?: '#' }}"
                                class="group inline-flex items-center gap-4 bg-primary px-6 py-4 font-heading text-xs font-bold uppercase tracking-[0.12em] text-white transition-all duration-300 hover:bg-white hover:text-black sm:px-8"
                            >
                                {{ $slide->button_label ?: 'Get Started' }}

                                <span class="transition-transform duration-300 group-hover:translate-x-1">
                                    →
                                </span>
                            </a>

                            <a
                                href="#services"
                                class="inline-flex items-center gap-3 border border-white/20 px-6 py-4 font-heading text-xs font-bold uppercase tracking-[0.12em] text-white transition-all duration-300 hover:border-white hover:bg-white hover:text-black sm:px-8"
                            >
                                Explore Services
                            </a>

                        </div>



                    </div>


                    {{-- RIGHT IMAGE / VISUAL --}}
                    <div class="relative hidden lg:block">

                        {{-- Main image frame --}}
                        <div class="relative ml-auto h-[500px] w-full max-w-[560px] overflow-hidden border border-white/10 bg-white/5">

                            <img
                                src="{{ $slide->imageUrl() }}"
                                alt="{{ $slide->headline }}"
                                class="h-full w-full object-cover"
                            >

                            {{-- Image overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>

                            {{-- Top label --}}
                            <div class="absolute left-6 top-6 flex items-center gap-2 border border-white/15 bg-black/30 px-4 py-2 backdrop-blur-md">
                                <span class="h-2 w-2 rounded-full bg-primary"></span>

                                <span class="font-heading text-[10px] font-bold uppercase tracking-[0.2em] text-white">
                                    Security Active
                                </span>
                            </div>

                            {{-- Bottom information card --}}
                            <div class="absolute bottom-6 left-6 right-6 border border-white/10 bg-black/60 p-5 backdrop-blur-xl">

                                <div class="flex items-end justify-between gap-5">

                                    <div>
                                        <p class="text-[10px] uppercase tracking-[0.2em] text-white/40">
                                            Protection Standard
                                        </p>

                                        <p class="mt-2 font-heading text-lg font-bold uppercase text-white">
                                            Professional & Reliable
                                        </p>
                                    </div>

                                    <div class="grid h-12 w-12 shrink-0 place-items-center rounded-full border border-primary/50 text-primary">
                                        <svg
                                            class="h-5 w-5"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            aria-hidden="true"
                                        >
                                            <path
                                                d="M12 3L19 6V11C19 15.5 16.1 19.6 12 21C7.9 19.6 5 15.5 5 11V6L12 3Z"
                                                stroke="currentColor"
                                                stroke-width="1.7"
                                            />
                                            <path
                                                d="M9 12L11 14L15 10"
                                                stroke="currentColor"
                                                stroke-width="1.7"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Floating number --}}
                        <div class="absolute -bottom-7 -left-7 border border-white/10 bg-[#10141D] px-7 py-5 shadow-2xl">

                            <p class="font-heading text-3xl font-bold text-primary">
                                01
                            </p>

                            <p class="mt-1 text-[9px] font-bold uppercase tracking-[0.2em] text-white/40">
                                Security First
                            </p>

                        </div>

                    </div>

                </div>

            </article>

        @empty

            {{-- Empty state --}}
            <article class="absolute inset-0 flex items-center justify-center bg-[#080B12]">

                <div class="text-center">

                    <div class="mx-auto mb-5 grid h-16 w-16 place-items-center rounded-full border border-white/10">
                        <svg
                            class="h-7 w-7 text-white/40"
                            viewBox="0 0 24 24"
                            fill="none"
                            aria-hidden="true"
                        >
                            <path
                                d="M12 3L19 6V11C19 15.5 16.1 19.6 12 21C7.9 19.6 5 15.5 5 11V6L12 3Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                            />
                        </svg>
                    </div>

                    <p class="font-heading text-sm font-bold uppercase tracking-[0.2em] text-white/50">
                        Add hero slides in the admin panel.
                    </p>

                </div>

            </article>

        @endforelse


        @if ($heroSlides->isNotEmpty())

            {{-- LEFT / RIGHT NAVIGATION --}}
            <div class="absolute bottom-8 right-5 z-30 flex items-center gap-2 sm:right-8 lg:right-12 xl:right-16">

                <button
                    id="heroPrev"
                    type="button"
                    aria-label="Previous slide"
                    class="group grid h-12 w-12 place-items-center border border-white/15 bg-black/20 text-white backdrop-blur-md transition-all duration-300 hover:border-primary hover:bg-primary"
                >
                    <svg
                        class="h-5 w-5 transition-transform duration-300 group-hover:-translate-x-1"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                    >
                        <path
                            d="M15 18L9 12L15 6"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </button>

                <button
                    id="heroNext"
                    type="button"
                    aria-label="Next slide"
                    class="group grid h-12 w-12 place-items-center border border-white/15 bg-black/20 text-white backdrop-blur-md transition-all duration-300 hover:border-primary hover:bg-primary"
                >
                    <svg
                        class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true"
                    >
                        <path
                            d="M9 18L15 12L9 6"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </button>

            </div>




        @endif

    </div>

</section>
