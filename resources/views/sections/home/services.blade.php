<section id="services" class="relative bg-gray-50 py-24 sm:py-32">
    
    <div class="mx-auto max-w-[1440px] px-5 sm:px-8 xl:px-12">
        
        <!-- Header -->
        <div class="mb-16 text-center md:mb-20">
            <h2 class="font-heading text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl md:text-5xl">
                Our Security Services
            </h2>
            <p class="mx-auto mt-4 max-w-2xl font-sans text-lg text-gray-600">
                Comprehensive protection solutions tailored to meet your specific security needs and ensure absolute peace of mind.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 xl:gap-10">
            @forelse ($homeServices as $service)
                @include('partials.service-card', [
                    'service' => $service,
                    'featured' => false,
                    'showDividerAfter' => false,
                    'showBody' => false,
                ])
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-gray-300 p-12 text-center">
                    <p class="font-sans text-sm font-medium text-gray-500">Add services in Admin → Pages → Services.</p>
                </div>
            @endforelse
        </div>
        
    </div>
</section>
