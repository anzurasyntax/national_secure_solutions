@extends('layouts.app')

@section('content')
    @include('sections.header', ['pageTitle' => 'Services'])
    <section class="mx-auto mb-28 max-w-[80%] px-6 py-12 md:px-12">
        <div class="mb-14 text-center">
            <p class="font-heading text-sm font-semibold uppercase tracking-[3px] text-primary">What We Do</p>
            <h1 class="font-heading text-[38px] font-bold text-[#1c1c25]">Our Services</h1>
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
