<section id="features" class="relative z-20 mx-auto w-full max-w-[1440px] px-5 py-16 sm:px-8 sm:py-24 xl:px-12">

    <div class="grid grid-cols-1 gap-6 md:grid-cols-3 md:gap-8">
        @forelse ($homeFeatures as $feature)
            <article class="group relative flex flex-col overflow-hidden rounded-2xl bg-white p-8 shadow-[0_4px_20px_rgb(0,0,0,0.03)] ring-1 ring-gray-100 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] sm:p-10">
                
                {{-- Top border accent --}}
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-gray-100 to-gray-200 transition-all duration-500 group-hover:from-primary group-hover:to-red-700"></div>
                
                <div class="relative z-10 flex flex-1 flex-col">
                    
                    {{-- Icon and Number --}}
                    <div class="mb-10 flex items-start justify-between">
                        
                        <div class="grid h-16 w-16 shrink-0 place-items-center rounded-2xl bg-[#080B12] text-primary shadow-lg ring-1 ring-gray-900/5 transition-transform duration-500 group-hover:scale-110 group-hover:bg-primary group-hover:text-white">
                            @include('sections.home.feature-icon', ['position' => $feature->position])
                        </div>
                        
                        <span class="font-heading text-6xl font-black tracking-tighter text-gray-100 transition-colors duration-500 group-hover:text-primary/10">
                            {{ $feature->displayNumber() }}
                        </span>
                        
                    </div>
                    
                    {{-- Text Content --}}
                    <h3 class="mb-4 font-heading text-2xl font-bold tracking-tight text-gray-900 transition-colors duration-300 group-hover:text-primary">
                        {{ $feature->title }}
                    </h3>
                    
                    <p class="flex-1 font-sans text-base leading-relaxed text-gray-600">
                        {{ $feature->description }}
                    </p>
                    
                    {{-- Read more link (Optional visual anchor) --}}
                    <div class="mt-8 flex items-center gap-2 opacity-0 transition-all duration-500 group-hover:opacity-100">
                        <span class="h-px w-6 bg-primary"></span>
                        <span class="font-heading text-[10px] font-bold uppercase tracking-widest text-primary">Discover</span>
                    </div>
                    
                </div>
            </article>
        @empty
            <div class="col-span-3 rounded-2xl border border-dashed border-gray-300 bg-gray-50 p-12 text-center">
                <p class="font-sans text-sm font-medium text-gray-500 uppercase tracking-widest">Add feature copy in the admin under Home page → Features.</p>
            </div>
        @endforelse
    </div>

</section>
