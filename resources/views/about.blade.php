@extends('layouts.app')

@section('content')
    @include('sections.header', ['pageTitle' => 'About Us'])
    @include('sections.home.about')


<div class="mx-auto max-w-[92%] px-4 py-10 sm:max-w-[88%] sm:px-6 sm:py-12 lg:max-w-[80%]">

    <!-- Memberships -->
    <section class="mb-8">
        <h2 class="mb-3 text-3xl font-bold text-black sm:text-4xl">{{ $aboutPage->memberships_heading }}</h2>
        <div class="text-base leading-relaxed text-black sm:text-xl [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->memberships_body !!}</div>
    </section>

    <!-- Leadership -->
    <section class="mb-8">
        <h2 class="mb-3 text-3xl font-bold text-black sm:text-4xl">{{ $aboutPage->leadership_heading }}</h2>
        <div class="text-base leading-relaxed text-black sm:text-xl [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->leadership_body !!}</div>
    </section>

    <!-- Bold statement -->
    <section class="mb-6">
        <div class="mb-4 text-xl font-black leading-snug text-black sm:text-2xl [&_p]:mb-0">{!! $aboutPage->statement_heading !!}</div>
        <ul class="list-disc list-inside space-y-2 text-black mb-5">
            @foreach ($aboutPage->statementListLines() as $line)
                <li>{{ $line }}</li>
            @endforeach
        </ul>
        <div class="text-black leading-relaxed [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->statement_footer !!}</div>
    </section>

    <hr class="border-gray-200 my-10" />

    <!-- Founder -->
    <section class="mb-10">
        <h2 class="mb-1 text-3xl font-bold text-black sm:text-4xl">{{ $aboutPage->founder_heading }}</h2>
        <h3 class="mb-4 text-lg font-extrabold tracking-wide text-black sm:text-xl">{{ $aboutPage->founder_subtitle }}</h3>
        <div class="text-black leading-relaxed [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->founder_body !!}</div>
    </section>

    <!-- Chairman -->
    <section class="mb-10">
        <h2 class="mb-1 text-3xl font-bold text-black sm:text-4xl">{{ $aboutPage->chairman_heading }}</h2>
        <h3 class="mb-4 text-lg font-extrabold tracking-wide text-black sm:text-xl">{{ $aboutPage->chairman_subtitle }}</h3>
        <div class="text-black leading-relaxed [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->chairman_body !!}</div>
    </section>

    <!-- President -->
    <section class="mb-10">
        <h2 class="mb-1 text-3xl font-bold text-black sm:text-4xl">{{ $aboutPage->president_heading }}</h2>
        <h3 class="mb-4 text-lg font-extrabold tracking-wide text-black sm:text-xl">{{ $aboutPage->president_subtitle }}</h3>
        <div class="text-black leading-relaxed [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->president_body !!}</div>
    </section>

</div>

@endsection
