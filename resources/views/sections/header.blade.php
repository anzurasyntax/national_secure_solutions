@php
    $pageTitle = $pageTitle ?? 'About Us';
@endphp
<!-- Inner page hero / breadcrumb -->
<section class="relative w-full h-52 md:h-64 overflow-hidden">

    <img
        src="{{ asset('img/bg.png') }}"
        alt=""
        class="absolute inset-0 w-full h-full object-cover object-center"
    />

    <div class="absolute inset-0 bg-[#1a2a4a] opacity-75"></div>

    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
        <h1 class="text-white text-4xl md:text-7xl font-bold mb-3 tracking-tight">{{ $pageTitle }}</h1>
        <nav class="flex items-center gap-2 text-lg" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="text-red-500 font-medium hover:underline">Home</a>
            <span class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </span>
            <span class="text-white font-medium">{{ $pageTitle }}</span>
        </nav>
    </div>

</section>
