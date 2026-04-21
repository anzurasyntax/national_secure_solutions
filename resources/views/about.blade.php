@extends('layouts.app')

@section('content')
    @include('sections.header', ['pageTitle' => 'About Us'])
    @include('sections.home.about')


<div class="max-w-[80%] mx-auto px-6 py-12">

    <!-- Memberships -->
    <section class="mb-8">
        <h2 class="text-4xl font-bold mb-3 text-black">{{ $aboutPage->memberships_heading }}</h2>
        <div class="text-black text-xl leading-relaxed [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->memberships_body !!}</div>
    </section>

    <!-- Leadership -->
    <section class="mb-8">
        <h2 class="text-4xl font-bold mb-3 text-black">{{ $aboutPage->leadership_heading }}</h2>
        <div class="text-black text-xl leading-relaxed [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->leadership_body !!}</div>
    </section>

    <!-- Bold statement -->
    <section class="mb-6">
        <div class="text-2xl text-black font-black leading-snug mb-4 [&_p]:mb-0">{!! $aboutPage->statement_heading !!}</div>
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
        <h2 class="text-4xl font-bold mb-1 text-black">{{ $aboutPage->founder_heading }}</h2>
        <h3 class="text-xl font-extrabold mb-4 text-black tracking-wide">{{ $aboutPage->founder_subtitle }}</h3>
        <div class="text-black leading-relaxed [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->founder_body !!}</div>
    </section>

    <!-- Chairman -->
    <section class="mb-10">
        <h2 class="text-4xl font-bold mb-1 text-black">{{ $aboutPage->chairman_heading }}</h2>
        <h3 class="text-xl font-extrabold mb-4 text-black tracking-wide">{{ $aboutPage->chairman_subtitle }}</h3>
        <div class="text-black leading-relaxed [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->chairman_body !!}</div>
    </section>

    <!-- President -->
    <section class="mb-10">
        <h2 class="text-4xl font-bold mb-1 text-black">{{ $aboutPage->president_heading }}</h2>
        <h3 class="text-xl font-extrabold mb-4 text-black tracking-wide">{{ $aboutPage->president_subtitle }}</h3>
        <div class="text-black leading-relaxed [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->president_body !!}</div>
    </section>

</div>

@endsection
