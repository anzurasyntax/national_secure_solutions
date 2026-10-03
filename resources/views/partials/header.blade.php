@php
    $isHome = request()->routeIs('home');

    $headerClasses = $isHome
        ? 'absolute inset-x-0 top-0 text-white'
        : 'sticky top-0 border-b border-gray-200 bg-white text-[#111827] shadow-sm';

    $navText = $isHome
        ? 'text-white hover:text-primary'
        : 'text-[#111827] hover:text-primary';

    $mobileMenuClasses = $isHome
        ? 'border-white/10 bg-[#080B12]/95 text-white'
        : 'border-gray-100 bg-white text-[#111827]';
@endphp

<header class="{{ $headerClasses }} z-50 w-full transition-colors duration-300">

    {{-- Top contact strip --}}
    <div class="{{ $isHome ? 'border-b border-white/10 bg-black/20' : 'border-b border-gray-100 bg-gray-50' }} hidden md:block">

        <div class="mx-auto flex max-w-[1440px] items-center justify-between gap-6 px-6 py-3 xl:px-12">

            <div class="flex flex-wrap items-center gap-x-8 gap-y-2 text-xs">

                @if ($siteSetting->email)
                    <a
                        href="mailto:{{ $siteSetting->email }}"
                        class="flex items-center gap-2 transition hover:text-primary"
                    >
                        <svg class="h-4 w-4 text-primary" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M3 6.5A2.5 2.5 0 015.5 4h13A2.5 2.5 0 0121 6.5v11a2.5 2.5 0 01-2.5 2.5h-13A2.5 2.5 0 013 17.5v-11z" stroke="currentColor" stroke-width="1.7"/>
                            <path d="M4 6l8 6 8-6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        {{ $siteSetting->email }}
                    </a>
                @endif

                @if ($siteSetting->phone)
                    <a
                        href="{{ $siteSetting->telHref() }}"
                        class="flex items-center gap-2 transition hover:text-primary"
                    >
                        <svg class="h-4 w-4 text-primary" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 3h4l2 5-3 2a15 15 0 006 6l2-3 5 2v4a2 2 0 01-2 2C10 21 3 14 3 5a2 2 0 012-2z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                        </svg>

                        {{ $siteSetting->phone }}
                    </a>
                @endif

            </div>

            <div class="flex items-center gap-5">

                @if ($siteSetting->working_time)
                    <span class="text-xs opacity-80">
                        {{ $siteSetting->working_time }}
                    </span>
                @endif

                <a
                    href="{{ route('contact-us') }}"
                    class="inline-flex items-center gap-2 bg-primary px-5 py-2.5 text-[11px] font-bold uppercase tracking-[0.12em] text-white transition hover:bg-red-700"
                >
                    Contact Us
                    <span aria-hidden="true">→</span>
                </a>

            </div>

        </div>
    </div>


    {{-- Main navigation --}}
    <div class="{{ $isHome ? 'bg-[#080B12]/20' : 'bg-white' }}">

        <div class="mx-auto flex h-[82px] max-w-[1440px] items-center justify-between gap-8 px-5 sm:px-8 xl:px-12">

            {{-- Logo --}}
            <a
                href="{{ route('home') }}"
                class="flex shrink-0 items-center"
                aria-label="National Secure Solutions home"
            >
                <img
                    src="{{ $siteSetting->logoUrl() }}"
                    alt="{{ config('app.name') }}"
                    class="h-12 w-auto max-w-[190px] object-contain sm:h-14 sm:max-w-[220px] {{ $isHome && $siteSetting->usesDefaultLogo() ? 'brightness-0 invert' : '' }}"
                >
            </a>


            {{-- Desktop navigation --}}
            <nav class="hidden items-center gap-7 lg:flex xl:gap-9" aria-label="Main navigation">

                <a
                    href="{{ route('home') }}"
                    class="nav-link text-sm font-bold uppercase tracking-wide transition {{ $navText }} {{ request()->routeIs('home') ? 'is-active' : '' }}"
                    @if(request()->routeIs('home')) aria-current="page" @endif
                >
                    Home
                </a>

                <a
                    href="{{ route('about') }}"
                    class="nav-link text-sm font-bold uppercase tracking-wide transition {{ $navText }} {{ request()->routeIs('about') ? 'is-active' : '' }}"
                    @if(request()->routeIs('about')) aria-current="page" @endif
                >
                    About Us
                </a>

                <a
                    href="{{ route('services') }}"
                    class="nav-link text-sm font-bold uppercase tracking-wide transition {{ $navText }} {{ request()->routeIs('services') ? 'is-active' : '' }}"
                    @if(request()->routeIs('services')) aria-current="page" @endif
                >
                    Services
                </a>

                <a
                    href="{{ route('training') }}"
                    class="nav-link text-sm font-bold uppercase tracking-wide transition {{ $navText }} {{ request()->routeIs('training') ? 'is-active' : '' }}"
                    @if(request()->routeIs('training')) aria-current="page" @endif
                >
                    Training
                </a>

                <a
                    href="{{ route('blog') }}"
                    class="nav-link text-sm font-bold uppercase tracking-wide transition {{ $navText }} {{ request()->routeIs('blog') ? 'is-active' : '' }}"
                    @if(request()->routeIs('blog')) aria-current="page" @endif
                >
                    Blog
                </a>

                <a
                    href="{{ route('contact-us') }}"
                    class="nav-link text-sm font-bold uppercase tracking-wide transition {{ $navText }} {{ request()->routeIs('contact-us') ? 'is-active' : '' }}"
                    @if(request()->routeIs('contact-us')) aria-current="page" @endif
                >
                    Contact
                </a>

            </nav>


            {{-- Desktop social links --}}
            <div class="hidden shrink-0 items-center gap-2 xl:flex">

                <a
                    href="{{ $siteSetting->facebook_url ?: '#' }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Facebook"
                    class="grid h-9 w-9 place-items-center border {{ $isHome ? 'border-white/20 bg-white/5 hover:bg-primary' : 'border-gray-200 bg-gray-50 hover:bg-primary' }} transition hover:border-primary"
                >
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M24 12.073C24 5.446 18.627.073 12 .073S0 5.446 0 12.073c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>

                <a
                    href="{{ $siteSetting->x_url ?: '#' }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="X"
                    class="grid h-9 w-9 place-items-center border {{ $isHome ? 'border-white/20 bg-white/5 hover:bg-primary' : 'border-gray-200 bg-gray-50 hover:bg-primary' }} transition hover:border-primary"
                >
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.259 5.63z"/>
                    </svg>
                </a>

                <a
                    href="{{ $siteSetting->youtube_url ?: '#' }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="YouTube"
                    class="grid h-9 w-9 place-items-center border {{ $isHome ? 'border-white/20 bg-white/5 hover:bg-primary' : 'border-gray-200 bg-gray-50 hover:bg-primary' }} transition hover:border-primary"
                >
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088C19.537 3.616 12 3.616 12 3.616s-7.537 0-9.407.501A3.007 3.007 0 00.505 6.205 31.247 31.247 0 000 12a31.247 31.247 0 00.505 5.795 3.007 3.007 0 002.088 2.088C4.463 20.384 12 20.384 12 20.384s7.537 0 9.407-.501a3.007 3.007 0 002.088-2.088A31.247 31.247 0 0024 12a31.247 31.247 0 00-.505-5.795zM9.6 15.6V8.4l6.3 3.6-6.3 3.6z"/>
                    </svg>
                </a>

                <a
                    href="{{ $siteSetting->pinterest_url ?: '#' }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Pinterest"
                    class="grid h-9 w-9 place-items-center border {{ $isHome ? 'border-white/20 bg-white/5 hover:bg-primary' : 'border-gray-200 bg-gray-50 hover:bg-primary' }} transition hover:border-primary"
                >
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 01.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.632-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/>
                    </svg>
                </a>

            </div>


            {{-- Mobile menu button --}}
            <button
                id="menuButton"
                type="button"
                class="grid h-11 w-11 shrink-0 place-items-center border {{ $isHome ? 'border-white/20 bg-white/5' : 'border-gray-200 bg-gray-50' }} lg:hidden"
                aria-label="Toggle navigation menu"
                aria-controls="mobileMenu"
                aria-expanded="false"
            >
                <svg id="menuIcon" class="h-6 w-6 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M3 6h18v2H3zm0 5h18v2H3zm0 5h18v2H3z"/>
                </svg>
            </button>

        </div>
    </div>


    {{-- One mobile menu shared across all pages --}}
    <div
        id="mobileMenu"
        class="absolute inset-x-0 top-full hidden border-t {{ $mobileMenuClasses }} shadow-2xl backdrop-blur-xl lg:hidden"
    >
        <nav class="mx-auto grid max-w-[1440px] gap-1 px-5 py-5 sm:px-8" aria-label="Mobile navigation">

            <a href="{{ route('home') }}"
               class="border-b border-current/10 py-3 text-sm font-bold uppercase tracking-wide transition hover:text-primary {{ request()->routeIs('home') ? 'text-primary' : '' }}">
                Home
            </a>

            <a href="{{ route('about') }}"
               class="border-b border-current/10 py-3 text-sm font-bold uppercase tracking-wide transition hover:text-primary {{ request()->routeIs('about') ? 'text-primary' : '' }}">
                About Us
            </a>

            <a href="{{ route('services') }}"
               class="border-b border-current/10 py-3 text-sm font-bold uppercase tracking-wide transition hover:text-primary {{ request()->routeIs('services') ? 'text-primary' : '' }}">
                Services
            </a>

            <a href="{{ route('training') }}"
               class="border-b border-current/10 py-3 text-sm font-bold uppercase tracking-wide transition hover:text-primary {{ request()->routeIs('training') ? 'text-primary' : '' }}">
                Training
            </a>

            <a href="{{ route('blog') }}"
               class="border-b border-current/10 py-3 text-sm font-bold uppercase tracking-wide transition hover:text-primary {{ request()->routeIs('blog') ? 'text-primary' : '' }}">
                Blog
            </a>

            <a href="{{ route('contact-us') }}"
               class="py-3 text-sm font-bold uppercase tracking-wide transition hover:text-primary {{ request()->routeIs('contact-us') ? 'text-primary' : '' }}">
                Contact Us
            </a>

            {{-- Mobile contact details --}}
            <div class="mt-4 grid gap-3 border-t border-current/10 pt-5 text-sm">

                @if ($siteSetting->phone)
                    <a href="{{ $siteSetting->telHref() }}" class="flex items-center gap-3 hover:text-primary">
                        <span class="text-primary">☎</span>
                        {{ $siteSetting->phone }}
                    </a>
                @endif

                @if ($siteSetting->email)
                    <a href="mailto:{{ $siteSetting->email }}" class="flex items-center gap-3 hover:text-primary">
                        <span class="text-primary">✉</span>
                        {{ $siteSetting->email }}
                    </a>
                @endif

                @if ($siteSetting->working_time)
                    <p class="pt-1 text-xs opacity-70">
                        {{ $siteSetting->working_time }}
                    </p>
                @endif

            </div>

            <a
                href="{{ route('contact-us') }}"
                class="mt-4 inline-flex items-center justify-center gap-3 bg-primary px-5 py-4 text-xs font-bold uppercase tracking-[0.15em] text-white transition hover:bg-red-700"
            >
                Contact Us
                <span aria-hidden="true">→</span>
            </a>

        </nav>
    </div>

</header>
