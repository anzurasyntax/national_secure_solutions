<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | National Secure Solutions</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
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
                        sans: ['Roboto', 'sans-serif'],
                        heading: ['Roboto', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <style>
        body { font-family: "Roboto", sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-[#f4f6f9] font-sans text-[#797979]">
<div class="flex min-h-screen">
    <aside class="hidden w-64 shrink-0 flex-col border-r border-white/10 bg-gradient-to-b from-ink to-[#111a35] text-white lg:flex">
        <div class="border-b border-white/10 px-6 py-6">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <img src="{{ $siteSetting->logoUrl() }}" alt="{{ config('app.name') }}" class="h-10 w-auto max-w-[200px] object-contain {{ $siteSetting->usesDefaultLogo() ? 'brightness-0 invert' : '' }}">
            </a>
            <p class="mt-3 font-heading text-xs font-semibold uppercase tracking-[0.2em] text-white/60">Admin</p>
        </div>
        <nav class="flex-1 space-y-1 px-3 py-4">
            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-primary/90 text-white" aria-hidden="true">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                </span>
                Dashboard
            </a>

            <details class="rounded-lg {{ request()->routeIs('admin.hero-slides.*', 'admin.home-features.*', 'admin.home-stats.*', 'admin.home-cta.*', 'admin.why-choose-us.*', 'admin.our-values.*', 'admin.testimonials.*') ? 'bg-white/5' : '' }}" {{ request()->routeIs('admin.hero-slides.*', 'admin.home-features.*', 'admin.home-stats.*', 'admin.home-cta.*', 'admin.why-choose-us.*', 'admin.our-values.*', 'admin.testimonials.*') ? 'open' : '' }}>
                <summary class="flex cursor-pointer list-none items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-white/75 transition marker:content-none hover:bg-white/5 hover:text-white [&::-webkit-details-marker]:hidden">
                    <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-white/15 text-white" aria-hidden="true">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                    </span>
                    <span class="flex-1 text-left">Home page</span>
                    <svg class="h-4 w-4 shrink-0 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="mt-1 space-y-1 border-l border-white/15 pb-1 pl-4 ml-7">
                    <a href="{{ route('admin.hero-slides.index') }}"
                       class="{{ request()->routeIs('admin.hero-slides.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3A1.5 1.5 0 001.5 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                        Hero Slider
                    </a>
                    <a href="{{ route('admin.home-features.edit') }}"
                       class="{{ request()->routeIs('admin.home-features.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"/></svg>
                        Features
                    </a>
                    <a href="{{ route('admin.home-stats.edit') }}"
                       class="{{ request()->routeIs('admin.home-stats.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                        Stats
                    </a>
                    <a href="{{ route('admin.home-cta.edit') }}"
                       class="{{ request()->routeIs('admin.home-cta.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                        CTA
                    </a>
                    <a href="{{ route('admin.why-choose-us.edit') }}"
                       class="{{ request()->routeIs('admin.why-choose-us.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Why Choose Us
                    </a>
                    <a href="{{ route('admin.our-values.index') }}"
                       class="{{ request()->routeIs('admin.our-values.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                        Our Values
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}"
                       class="{{ request()->routeIs('admin.testimonials.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/></svg>
                        Testimonials
                    </a>
                </div>
            </details>

            <details class="rounded-lg {{ request()->routeIs('admin.about-page.*', 'admin.services.*') ? 'bg-white/5' : '' }}" {{ request()->routeIs('admin.about-page.*', 'admin.services.*') ? 'open' : '' }}>
                <summary class="flex cursor-pointer list-none items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-white/75 transition marker:content-none hover:bg-white/5 hover:text-white [&::-webkit-details-marker]:hidden">
                    <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-white/15 text-white" aria-hidden="true">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 18H21a2.25 2.25 0 002.25-2.25v-7.5A2.25 2.25 0 0019.5 6h-7.5a2.25 2.25 0 00-2.25 2.25v12m6.75-15H3.75A2.25 2.25 0 001.5 6v12a2.25 2.25 0 002.25 2.25h10.5A2.25 2.25 0 0016.5 18v-7.5A2.25 2.25 0 0014.25 8.25h-7.5z"/></svg>
                    </span>
                    <span class="flex-1 text-left">Pages</span>
                    <svg class="h-4 w-4 shrink-0 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="mt-1 space-y-1 border-l border-white/15 pb-1 pl-4 ml-7">
                    <a href="{{ route('admin.about-page.edit') }}"
                       class="{{ request()->routeIs('admin.about-page.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                        About page
                    </a>
                    <a href="{{ route('admin.services.index') }}"
                       class="{{ request()->routeIs('admin.services.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655-5.653a2.548 2.548 0 010-3.344l3.43-4.171a2.528 2.528 0 013.344 0l5.653 4.654a2.548 2.548 0 010 3.344l-4.284 5.204"/></svg>
                        Services
                    </a>
                </div>
            </details>

            <details class="rounded-lg {{ request()->routeIs('admin.blog-posts.*', 'admin.blog-categories.*', 'admin.blog-tags.*') ? 'bg-white/5' : '' }}" {{ request()->routeIs('admin.blog-posts.*', 'admin.blog-categories.*', 'admin.blog-tags.*') ? 'open' : '' }}>
                <summary class="flex cursor-pointer list-none items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-white/75 transition marker:content-none hover:bg-white/5 hover:text-white [&::-webkit-details-marker]:hidden">
                    <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-white/15 text-white" aria-hidden="true">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 18H21a2.25 2.25 0 002.25-2.25v-7.5A2.25 2.25 0 0019.5 6h-7.5a2.25 2.25 0 00-2.25 2.25v12m6.75-15H3.75A2.25 2.25 0 001.5 6v12a2.25 2.25 0 002.25 2.25h10.5A2.25 2.25 0 0016.5 18v-7.5A2.25 2.25 0 0014.25 8.25h-7.5z"/></svg>
                    </span>
                    <span class="flex-1 text-left">Blog</span>
                    <svg class="h-4 w-4 shrink-0 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="mt-1 space-y-1 border-l border-white/15 pb-1 pl-4 ml-7">
                    <a href="{{ route('admin.blog-posts.index') }}"
                       class="{{ request()->routeIs('admin.blog-posts.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                        Posts
                    </a>
                    <a href="{{ route('admin.blog-categories.index') }}"
                       class="{{ request()->routeIs('admin.blog-categories.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125h19.5M3.75 7.125v11.25c0 .621.504 1.125 1.125 1.125h14.25c.621 0 1.125-.504 1.125-1.125V7.125m-16.5 3.75h15"/></svg>
                        Categories
                    </a>
                    <a href="{{ route('admin.blog-tags.index') }}"
                       class="{{ request()->routeIs('admin.blog-tags.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 9h.008v.008H6V9z"/></svg>
                        Tags
                    </a>
                </div>
            </details>

            <details class="rounded-lg {{ request()->routeIs('admin.courses.*', 'admin.course-orders.*') ? 'bg-white/5' : '' }}" {{ request()->routeIs('admin.courses.*', 'admin.course-orders.*') ? 'open' : '' }}>
                <summary class="flex cursor-pointer list-none items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-white/75 transition marker:content-none hover:bg-white/5 hover:text-white [&::-webkit-details-marker]:hidden">
                    <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-white/15 text-white" aria-hidden="true">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/></svg>
                    </span>
                    <span class="flex-1 text-left">Online courses</span>
                    <svg class="h-4 w-4 shrink-0 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="mt-1 space-y-1 border-l border-white/15 pb-1 pl-4 ml-7">
                    <a href="{{ route('admin.courses.index') }}"
                       class="{{ request()->routeIs('admin.courses.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                        Courses &amp; modules
                    </a>
                    <a href="{{ route('admin.course-orders.index') }}"
                       class="{{ request()->routeIs('admin.course-orders.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition">
                        <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.85l1.651 6.618A2.25 2.25 0 007.318 13h11.364a2.25 2.25 0 002.227-1.932l1.652-6.618A1.125 1.125 0 0021.75 9H8.106a2.25 2.25 0 00-2.227 1.932l-.728 2.913m0 0a2.25 2.25 0 002.227 1.932H12m0 0h3.75m-3.75 0v-3.75m0 3.75h3.75m-3.75 0h-3.75"/></svg>
                        Orders
                    </a>
                </div>
            </details>

            <a href="{{ route('admin.site-settings.edit') }}"
               class="{{ request()->routeIs('admin.site-settings.*') ? 'bg-white/10 text-white' : 'text-white/75 hover:bg-white/5 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-navy text-white" aria-hidden="true">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 010 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 010-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0Z"/>
                    </svg>
                </span>
                CMS
            </a>
        </nav>
        <div class="border-t border-white/10 px-4 py-4 space-y-2">
            <a href="{{ url('/') }}" class="block rounded-lg px-3 py-2 text-sm text-white/80 hover:bg-white/5 hover:text-white transition">
                View website
            </a>
            <form method="POST" action="{{ route('admin.logout') }}">
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
                <a href="{{ route('admin.site-settings.edit') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">CMS</a>
                <a href="{{ route('admin.about-page.edit') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">About</a>
                <a href="{{ route('admin.services.index') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Services</a>
                <a href="{{ route('admin.our-values.index') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Values</a>
                <a href="{{ route('admin.testimonials.index') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Reviews</a>
                <a href="{{ route('admin.courses.index') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Courses</a>
                <a href="{{ route('admin.course-orders.index') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Orders</a>
                <a href="{{ route('admin.blog-posts.index') }}" class="rounded-md border border-gray-200 px-2 py-1 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50">Blog</a>
            </div>
            <div class="hidden lg:block">
                <h1 class="font-heading text-xl font-bold uppercase tracking-wide text-ink">@yield('heading', 'Dashboard')</h1>
                <p class="text-sm text-gray-500">National Secure Solutions — control panel</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="hidden text-sm text-gray-600 sm:inline">{{ Auth::user()?->email }}</span>
                <a href="{{ url('/') }}" class="hidden rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold uppercase tracking-wide text-ink hover:bg-gray-50 sm:inline-block">
                    Site
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="inline">
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
