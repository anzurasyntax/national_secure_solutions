<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Trans-World Security</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ee1a28',
                        navy: '#1a1f6e',
                        ink: '#0b0f1e',
                    },
                    fontFamily: {
                        sans: ['Open Sans', 'sans-serif'],
                        heading: ['Oswald', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <style>
        body { font-family: "Open Sans", sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-[#f4f6f9] font-sans text-[#797979]">
<div class="flex min-h-screen">
    <aside class="hidden w-64 shrink-0 flex-col border-r border-white/10 bg-gradient-to-b from-ink to-[#111a35] text-white lg:flex">
        <div class="border-b border-white/10 px-6 py-6">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <img src="{{ asset('img/logo.png') }}" alt="Trans-World Security" class="h-10 w-auto brightness-0 invert">
            </a>
            <p class="mt-3 font-heading text-xs font-semibold uppercase tracking-[0.2em] text-white/60">Admin</p>
        </div>
        <nav class="flex-1 space-y-1 px-3 py-4">
            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-md bg-primary/90 font-heading text-xs font-bold">D</span>
                Dashboard
            </a>

            <details class="rounded-lg {{ request()->routeIs('admin.hero-slides.*', 'admin.home-features.*', 'admin.home-stats.*', 'admin.home-cta.*', 'admin.why-choose-us.*', 'admin.our-values.*') ? 'bg-white/5' : '' }}" {{ request()->routeIs('admin.hero-slides.*', 'admin.home-features.*', 'admin.home-stats.*', 'admin.home-cta.*', 'admin.why-choose-us.*', 'admin.our-values.*') ? 'open' : '' }}>
                <summary class="flex cursor-pointer list-none items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-white/75 transition marker:content-none hover:bg-white/5 hover:text-white [&::-webkit-details-marker]:hidden">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-md bg-white/15 font-heading text-xs font-bold">H</span>
                    <span class="flex-1 text-left">Home page</span>
                    <svg class="h-4 w-4 shrink-0 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="mt-1 space-y-1 border-l border-white/15 pb-1 pl-4 ml-7">
                    <a href="{{ route('admin.hero-slides.index') }}"
                       class="{{ request()->routeIs('admin.hero-slides.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} block rounded-lg px-3 py-2 text-sm transition">
                        Hero Slider
                    </a>
                    <a href="{{ route('admin.home-features.edit') }}"
                       class="{{ request()->routeIs('admin.home-features.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} block rounded-lg px-3 py-2 text-sm transition">
                        Features
                    </a>
                    <a href="{{ route('admin.home-stats.edit') }}"
                       class="{{ request()->routeIs('admin.home-stats.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} block rounded-lg px-3 py-2 text-sm transition">
                        Stats
                    </a>
                    <a href="{{ route('admin.home-cta.edit') }}"
                       class="{{ request()->routeIs('admin.home-cta.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} block rounded-lg px-3 py-2 text-sm transition">
                        CTA
                    </a>
                    <a href="{{ route('admin.why-choose-us.edit') }}"
                       class="{{ request()->routeIs('admin.why-choose-us.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} block rounded-lg px-3 py-2 text-sm transition">
                        Why Choose Us
                    </a>
                    <a href="{{ route('admin.our-values.index') }}"
                       class="{{ request()->routeIs('admin.our-values.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} block rounded-lg px-3 py-2 text-sm transition">
                        Our Values
                    </a>
                </div>
            </details>

            <a href="{{ route('admin.site-settings.edit') }}"
               class="{{ request()->routeIs('admin.site-settings.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-md bg-navy font-heading text-xs font-bold">C</span>
                Site &amp; footer
            </a>

            <details class="rounded-lg {{ request()->routeIs('admin.about-page.*', 'admin.services.*') ? 'bg-white/5' : '' }}" {{ request()->routeIs('admin.about-page.*', 'admin.services.*') ? 'open' : '' }}>
                <summary class="flex cursor-pointer list-none items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-white/75 transition marker:content-none hover:bg-white/5 hover:text-white [&::-webkit-details-marker]:hidden">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-md bg-white/15 font-heading text-xs font-bold">P</span>
                    <span class="flex-1 text-left">Pages</span>
                    <svg class="h-4 w-4 shrink-0 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="mt-1 space-y-1 border-l border-white/15 pb-1 pl-4 ml-7">
                    <a href="{{ route('admin.about-page.edit') }}"
                       class="{{ request()->routeIs('admin.about-page.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} block rounded-lg px-3 py-2 text-sm transition">
                        About page
                    </a>
                    <a href="{{ route('admin.services.index') }}"
                       class="{{ request()->routeIs('admin.services.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} block rounded-lg px-3 py-2 text-sm transition">
                        Services
                    </a>
                </div>
            </details>
        </nav>
        <div class="border-t border-white/10 px-4 py-4 space-y-2">
            <a href="{{ url('/') }}" class="block rounded-lg px-3 py-2 text-sm text-white/80 hover:bg-white/5 hover:text-white transition">
                View website
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full rounded-lg bg-primary px-3 py-2 text-left font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/30 transition hover:bg-red-700">
                    Log out
                </button>
            </form>
        </div>
    </aside>

    <div class="flex min-h-screen flex-1 flex-col">
        <header class="sticky top-0 z-40 flex items-center justify-between gap-4 border-b border-gray-200 bg-white px-4 py-4 shadow-sm lg:px-8">
            <div class="flex flex-wrap items-center gap-2 lg:hidden">
                <span class="font-heading text-lg font-bold uppercase tracking-wide text-ink">Admin</span>
                <a href="{{ route('admin.dashboard') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Dashboard</a>
                <a href="{{ route('admin.hero-slides.index') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Hero</a>
                <a href="{{ route('admin.home-features.edit') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Features</a>
                <a href="{{ route('admin.home-stats.edit') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Stats</a>
                <a href="{{ route('admin.home-cta.edit') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">CTA</a>
                <a href="{{ route('admin.why-choose-us.edit') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Why Us</a>
                <a href="{{ route('admin.site-settings.edit') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Site</a>
                <a href="{{ route('admin.about-page.edit') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">About</a>
                <a href="{{ route('admin.services.index') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Services</a>
                <a href="{{ route('admin.our-values.index') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Values</a>
            </div>
            <div class="hidden lg:block">
                <h1 class="font-heading text-xl font-bold uppercase tracking-wide text-ink">@yield('heading', 'Dashboard')</h1>
                <p class="text-sm text-gray-500">Trans-World Security — control panel</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="hidden text-sm text-gray-600 sm:inline">{{ Auth::user()?->email }}</span>
                <a href="{{ url('/') }}" class="hidden rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50 sm:inline-block">
                    Site
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="rounded-lg bg-primary px-4 py-2 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white hover:bg-red-700">
                        Log out
                    </button>
                </form>
            </div>
        </header>

        <main class="flex-1 p-4 lg:p-8">
            <div class="mx-auto max-w-6xl space-y-6">
                @include('admin.partials.flash')
                @yield('content')
            </div>
        </main>
    </div>
</div>
@stack('scripts')
</body>
</html>
