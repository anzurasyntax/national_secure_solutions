@if (request()->routeIs('home'))
{{-- Home: overlay header (absolute) — unchanged behavior over hero --}}
<header class="absolute inset-x-0 top-0 z-50 text-white">
    <div class="mx-auto mt-4 hidden max-w-[75%] px-4 xl:block">
        <div class="rounded-full bg-[#FF000042]/10 px-12 py-7 backdrop-blur-sm">
            <div class="flex h-[64px] items-center justify-between gap-4">

                <!-- Email -->
                <div class="flex items-center gap-3">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full border-2 border-white bg-[#cc2222]">
                        <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[18px] text-white">If your any query:</p>
                        <p class="text-[18px] font-bold text-white">
                            <a href="mailto:{{ $siteSetting->email }}" class="transition-colors hover:text-primary">{{ $siteSetting->email }}</a>
                        </p>
                    </div>
                </div>

                <div class="h-8 w-px bg-black/15"></div>

                <!-- Phone -->
                <div class="flex items-center gap-3">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full border-2 border-white bg-[#cc2222]">
                        <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[18px] text-white">Have any question?</p>
                        <p class="text-[18px] font-bold text-white">
                            <a href="{{ $siteSetting->telHref() }}" class="transition-colors hover:text-primary">{{ $siteSetting->phone }}</a>
                        </p>
                    </div>
                </div>

                <div class="flex-1"></div>

                <!-- Hours -->
                <p class="whitespace-nowrap text-[18px] text-white">{{ $siteSetting->working_time }}</p>

                <!-- Button -->
                <a href="{{ route('contact-us') }}" class="rounded bg-[#cc2222] px-3 py-3 text-[17px] font-bold uppercase tracking-wide text-white transition hover:bg-[#a81b1b]">
                    Contact Us
                </a>
            </div>
        </div>
        <div class="mt-7 flex h-[76px] items-center justify-between px-12 py-7">
            <a href="{{ route('home') }}" class="shrink-0">
                <div class="flex items-center gap-2">
                    <div class="leading-tight">
                        <img src="{{ $siteSetting->logoUrl() }}" class="h-16 w-auto max-w-[13rem] object-contain {{ $siteSetting->usesDefaultLogo() ? 'brightness-0 invert' : '' }}" alt="{{ config('app.name') }}">
                    </div>
                </div>
            </a>
            <nav class="flex items-center gap-10">
                <a href="{{ route('home') }}" class="nav-link text-[20px] text-white">Home</a>
                <a href="{{ route('about') }}" class="nav-link text-[20px] text-white">About Us</a>
                <a href="{{ route('services') }}" class="nav-link text-[20px] text-white">Services</a>
                <a href="{{ route('training') }}" class="nav-link text-[20px] text-white">Training</a>
                <a href="{{ route('blog') }}" class="nav-link text-[20px] text-white {{ request()->routeIs('blog') ? 'text-primary' : '' }}">Blog</a>
                <a href="{{ route('contact-us') }}" class="nav-link text-[20px] text-white">Contact Us</a>
            </nav>
            <div class="flex items-center gap-2">
                <a href="{{ $siteSetting->facebook_url ?: '#' }}" class="grid h-10 w-10 place-items-center rounded-full bg-white/30 transition hover:bg-white/50" aria-label="Facebook">
                    <svg class="h-5 w-5 fill-white" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="{{ $siteSetting->x_url ?: '#' }}" class="grid h-10 w-10 place-items-center rounded-full bg-white/30 transition hover:bg-white/50" aria-label="X">
                    <svg class="h-5 w-5 fill-white" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.259 5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="{{ $siteSetting->youtube_url ?: '#' }}" class="grid h-10 w-10 place-items-center rounded-full bg-white/30 transition hover:bg-white/50" aria-label="Youtube">
                    <svg class="h-5 w-5 fill-white" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                </a>
                <a href="{{ $siteSetting->pinterest_url ?: '#' }}" class="grid h-10 w-10 place-items-center rounded-full bg-white/30 transition hover:bg-white/50" aria-label="Pinterest">
                    <svg class="h-5 w-5 fill-white" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 0 1 .083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.632-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/></svg>
                </a>
            </div>
        </div>
    </div>

    <div class="block border-b border-white/20 bg-black/45 xl:hidden">
        <div class="mx-auto flex h-[78px] max-w-[1170px] items-center justify-between px-4">
            <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2">
                <img src="{{ $siteSetting->logoUrl() }}" class="h-10 w-auto max-w-[180px] object-contain {{ $siteSetting->usesDefaultLogo() ? 'brightness-0 invert' : '' }}" alt="{{ config('app.name') }}">
            </a>
            <button id="menuButton" type="button" class="rounded border border-white/30 p-2" aria-label="Toggle Menu">
                <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current"><path d="M3 6h18v2H3zm0 5h18v2H3zm0 5h18v2H3z"/></svg>
            </button>
        </div>
        <div id="mobileMenu" class="hidden border-t border-white/20 bg-[#070e20] px-4 py-4">
            <div class="grid gap-3">
                <a href="{{ route('home') }}" class="font-heading text-sm uppercase text-white hover:text-primary">Home</a>
                <a href="{{ route('about') }}" class="font-heading text-sm uppercase text-white hover:text-primary">About Us</a>
                <a href="{{ route('services') }}" class="font-heading text-sm uppercase text-white hover:text-primary">Services</a>
                <a href="{{ route('training') }}" class="font-heading text-sm uppercase text-white hover:text-primary">Training</a>
                <a href="{{ route('blog') }}" class="font-heading text-sm uppercase {{ request()->routeIs('blog') ? 'text-primary' : 'text-white hover:text-primary' }}">Blog</a>
                <a href="{{ route('contact-us') }}" class="font-heading text-sm uppercase text-white hover:text-primary">Contact Us</a>
            </div>
        </div>
    </div>
</header>

@else
{{-- Inner pages: solid bar in document flow (not absolute) — matches reference layout --}}
<header class="sticky top-0 z-50 w-full border-t border-gray-200 border-b border-gray-200 bg-white shadow-[0_1px_0_rgba(0,0,0,0.06)]">
    <div class="mx-auto hidden max-w-[1170px] items-center justify-between gap-8 px-6 py-5 lg:flex">
        <a href="{{ route('home') }}" class="shrink-0">
            <img src="{{ $siteSetting->logoUrl() }}" class="h-12 w-auto max-w-[220px] object-contain sm:h-14" alt="{{ config('app.name') }}">
        </a>

        <nav class="flex flex-1 flex-wrap items-center justify-center gap-x-6 gap-y-2 xl:gap-x-10">
            <a href="{{ route('home') }}" class="nav-link-inner font-heading text-[17px] font-semibold xl:text-[16px] {{ request()->routeIs('home') ? 'text-primary' : 'text-[#1c1c25]' }} transition-colors hover:text-primary">Home</a>
            <a href="{{ route('about') }}" class="nav-link-inner font-heading text-[17px] font-semibold xl:text-[16px] {{ request()->routeIs('about') ? 'text-primary' : 'text-[#1c1c25]' }} transition-colors hover:text-primary">About Us</a>
            <a href="{{ route('services') }}" class="nav-link-inner font-heading text-[17px] font-semibold xl:text-[16px] {{ request()->routeIs('services') ? 'text-primary' : 'text-[#1c1c25]' }} transition-colors hover:text-primary">Services</a>
            <a href="{{ route('training') }}" class="nav-link-inner font-heading text-[17px] font-semibold xl:text-[16px] {{ request()->routeIs('training') ? 'text-primary' : 'text-[#1c1c25]' }} transition-colors hover:text-primary">Training</a>
            <a href="{{ route('blog') }}" class="nav-link-inner font-heading text-[17px] font-semibold xl:text-[16px] {{ request()->routeIs('blog') ? 'text-primary' : 'text-[#1c1c25]' }} transition-colors hover:text-primary">Blog</a>
            <a href="{{ route('contact-us') }}" class="nav-link-inner font-heading text-[17px] font-semibold xl:text-[16px] {{ request()->routeIs('contact-us') ? 'text-primary' : 'text-[#1c1c25]' }} transition-colors hover:text-primary">Contact Us</a>
        </nav>

        <div class="flex shrink-0 items-center gap-2">
            <a href="{{ $siteSetting->facebook_url ?: '#' }}" class="grid h-10 w-10 place-items-center rounded-full bg-primary text-white shadow-sm transition hover:bg-red-700" aria-label="Facebook">
                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <a href="{{ $siteSetting->x_url ?: '#' }}" class="grid h-10 w-10 place-items-center rounded-full bg-primary text-white shadow-sm transition hover:bg-red-700" aria-label="X">
                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.259 5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
            <a href="{{ $siteSetting->youtube_url ?: '#' }}" class="grid h-10 w-10 place-items-center rounded-full bg-primary text-white shadow-sm transition hover:bg-red-700" aria-label="Youtube">
                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
            </a>
            <a href="{{ $siteSetting->pinterest_url ?: '#' }}" class="grid h-10 w-10 place-items-center rounded-full bg-primary text-white shadow-sm transition hover:bg-red-700" aria-label="Pinterest">
                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 0 1 .083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.632-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/></svg>
            </a>
        </div>
    </div>

    {{-- Mobile inner --}}
    <div class="flex items-center justify-between gap-4 border-b border-gray-100 px-4 py-4 lg:hidden">
        <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2">
            <img src="{{ $siteSetting->logoUrl() }}" class="h-10 w-auto max-w-[180px] object-contain" alt="{{ config('app.name') }}">
        </a>
        <button id="menuButtonInner" type="button" class="rounded-lg border border-gray-300 p-2 text-[#1c1c25]" aria-label="Toggle Menu">
            <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current"><path d="M3 6h18v2H3zm0 5h18v2H3zm0 5h18v2H3z"/></svg>
        </button>
    </div>
    <div id="mobileMenuInner" class="hidden border-t border-gray-100 bg-gray-50 px-4 py-4 lg:hidden">
        <div class="grid gap-3">
            <a href="{{ route('home') }}" class="font-heading text-sm font-semibold uppercase tracking-wide {{ request()->routeIs('home') ? 'text-primary' : 'text-[#1c1c25]' }}">Home</a>
            <a href="{{ route('about') }}" class="font-heading text-sm font-semibold uppercase tracking-wide {{ request()->routeIs('about') ? 'text-primary' : 'text-[#1c1c25]' }}">About Us</a>
            <a href="{{ route('services') }}" class="font-heading text-sm font-semibold uppercase tracking-wide {{ request()->routeIs('services') ? 'text-primary' : 'text-[#1c1c25]' }}">Services</a>
            <a href="{{ route('training') }}" class="font-heading text-sm font-semibold uppercase tracking-wide {{ request()->routeIs('training') ? 'text-primary' : 'text-[#1c1c25]' }}">Training</a>
            <a href="{{ route('blog') }}" class="font-heading text-sm font-semibold uppercase tracking-wide {{ request()->routeIs('blog') ? 'text-primary' : 'text-[#1c1c25]' }}">Blog</a>
            <a href="{{ route('contact-us') }}" class="font-heading text-sm font-semibold uppercase tracking-wide {{ request()->routeIs('contact-us') ? 'text-primary' : 'text-[#1c1c25]' }}">Contact Us</a>
        </div>
    </div>
</header>
@endif
