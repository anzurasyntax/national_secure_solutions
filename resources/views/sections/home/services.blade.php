<section id="services" class="mx-auto max-w-[80%] px-24 py-16">

    <!-- Header -->
    <div class="mb-14 text-center">
        <p class="font-heading text-sm font-semibold uppercase tracking-[3px] text-primary">What We Do</p>
        <h2 class="font-heading text-[38px] font-bold text-[#1c1c25]">Our Services</h2>
        <span class="mx-auto mt-4 block h-[4px] w-14 rounded-xl bg-primary"></span>
    </div>

    @forelse ($homeServices as $service)
        @if ($loop->first)
            <div class="flex flex-col items-start gap-8 lg:flex-row lg:justify-center">
        @endif

        @include('partials.service-card', [
            'service' => $service,
            'featured' => $homeServices->count() === 3 && $loop->iteration === 2,
            'showDividerAfter' => ! $loop->last,
            'showBody' => false,
        ])

        @if ($loop->last)
            </div>
        @endif
    @empty
        <p class="text-center text-gray-500">Add services in Admin → Pages → Services.</p>
    @endforelse

</section>
