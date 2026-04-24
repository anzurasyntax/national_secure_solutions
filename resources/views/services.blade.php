@extends('layouts.app')

@section('content')
    @include('sections.header', ['pageTitle' => 'Services'])
    <section class="mx-auto mb-20 max-w-[92%] px-4 py-10 sm:max-w-[88%] sm:px-6 sm:py-12 md:px-10 lg:mb-28 lg:max-w-[80%] lg:px-12">
        <div class="mb-14 text-center">
            <p class="font-heading text-sm font-semibold uppercase tracking-[3px] text-primary">What We Do</p>
            <h1 class="font-heading text-3xl font-bold text-[#1c1c25] sm:text-[38px]">Our Services</h1>
            <span class="mx-auto mt-4 block h-[4px] w-14 rounded-xl bg-primary"></span>
        </div>

        @forelse ($services as $service)
            @if ($loop->first)
                <div class="grid grid-cols-1 gap-10 md:grid-cols-2 xl:grid-cols-3">
            @endif

            @include('partials.service-card', [
                'service' => $service,
                'featured' => false,
                'showDividerAfter' => false,
                'showBody' => filled($service->body),
            ])

            @if ($loop->last)
                </div>
            @endif
        @empty
            <p class="text-center text-gray-500">No services published yet.</p>
        @endforelse
    </section>
@endsection
