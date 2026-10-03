@props([
    'service',
    'featured' => false,
    'showBody' => false,
])

<article id="service-{{ $service->id }}" class="group flex h-full flex-col overflow-hidden rounded-2xl bg-white shadow-[0_4px_20px_rgb(0,0,0,0.05)] ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_20px_40px_rgb(0,0,0,0.1)] hover:ring-primary/20">
    
    {{-- Image Section --}}
    <div class="relative h-64 w-full overflow-hidden sm:h-72">
        <img src="{{ asset($service->image_path) }}"
             alt="{{ $service->title }}"
             class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
        
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
        
        {{-- Floating Icon --}}
        <div class="absolute bottom-6 left-6 grid h-14 w-14 place-items-center rounded-xl bg-white shadow-lg ring-1 ring-black/5 transition-transform duration-300 group-hover:-translate-y-2">
            <img src="{{ asset($service->icon_path) }}" alt="" class="h-8 w-8 object-contain transition-transform duration-300 group-hover:scale-110">
        </div>
    </div>

    {{-- Content Section --}}
    <div class="flex flex-1 flex-col p-8 sm:p-10">
        <h3 class="font-heading text-2xl font-bold text-gray-900 transition-colors duration-300 group-hover:text-primary">
            {{ $service->title }}
        </h3>
        
        <p class="mt-4 font-sans text-base leading-relaxed text-gray-600">
            {{ $service->excerpt }}
        </p>
        
        @if ($showBody && filled($service->body))
            <div class="mt-6 font-sans text-base leading-relaxed text-gray-600">
                {!! $service->body !!}
            </div>
        @endif
        
        <div class="mt-8">
            <a href="{{ route('services') }}#service-{{ $service->id }}" class="inline-flex items-center gap-2 font-heading text-sm font-bold uppercase tracking-widest text-primary hover:text-red-700">
                Read More
                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</article>
