<section id="features" class="relative z-10 mx-auto -mt-12 grid w-[80%] grid-cols-1 gap-6 pb-16 md:grid-cols-3">

    @forelse ($homeFeatures as $feature)
        <article class="rounded-[10px] group relative overflow-hidden bg-white px-7 pb-8 pt-9 shadow-[0_10px_35px_rgba(0,0,0,0.12)]">
            <span class="absolute -bottom-28 -right-20 h-48 w-48 rounded-full bg-primary/10 transition-all duration-500 ease-in-out group-hover:h-[800px] group-hover:w-[750px] group-hover:-bottom-48 group-hover:-right-48 group-hover:bg-primary/10 z-0"></span>
            <div class="relative z-10">
                <div class="mb-6 flex items-start justify-between">
                    <div class="inline-flex h-20 w-20 items-end justify-start rounded-full bg-primary/10 transition-colors duration-500">
                        <div class="bg-primary h-[67px] w-[67px] rounded-full inline-flex items-center justify-center">
                            @include('sections.home.feature-icon', ['position' => $feature->position])
                        </div>
                    </div>
                    <span class="font-heading text-[64px] font-bold leading-none text-gray-200 transition-colors duration-500">{{ $feature->displayNumber() }}</span>
                </div>
                <h3 class="mb-4 font-heading text-[28px] font-bold text-[#1c1c25] transition-colors duration-500">{{ $feature->title }}</h3>
                <p class="leading-[40px] text-gray-500 text-[20px] transition-colors duration-500">{{ $feature->description }}</p>
            </div>
        </article>
    @empty
        <p class="col-span-3 text-center text-gray-500">Add feature copy in the admin under Home page → Features.</p>
    @endforelse

</section>
