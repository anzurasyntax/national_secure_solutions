<section id="features" class="relative z-10 mx-auto -mt-10 grid w-[92%] grid-cols-1 gap-6 pb-14 sm:w-[88%] md:-mt-12 md:w-[80%] md:grid-cols-3 md:pb-16">

    @forelse ($homeFeatures as $feature)
        <article class="group relative overflow-hidden rounded-[10px] bg-white px-5 pb-7 pt-7 shadow-[0_10px_35px_rgba(0,0,0,0.12)] sm:px-7 sm:pb-8 sm:pt-9">
            <span class="absolute -bottom-28 -right-20 h-48 w-48 rounded-full bg-primary/10 transition-all duration-500 ease-in-out group-hover:h-[800px] group-hover:w-[750px] group-hover:-bottom-48 group-hover:-right-48 group-hover:bg-primary/10 z-0"></span>
            <div class="relative z-10">
                <div class="mb-6 flex items-start justify-between">
                    <div class="inline-flex h-20 w-20 items-end justify-start rounded-full bg-primary/10 transition-colors duration-500">
                        <div class="bg-primary h-[67px] w-[67px] rounded-full inline-flex items-center justify-center">
                            @include('sections.home.feature-icon', ['position' => $feature->position])
                        </div>
                    </div>
                    <span class="font-heading text-5xl font-bold leading-none text-gray-200 transition-colors duration-500 sm:text-[64px]">{{ $feature->displayNumber() }}</span>
                </div>
                <h3 class="mb-3 font-heading text-2xl font-bold text-[#1c1c25] transition-colors duration-500 sm:mb-4 sm:text-[28px]">{{ $feature->title }}</h3>
                <p class="text-base leading-8 text-gray-500 transition-colors duration-500 sm:text-[20px] sm:leading-[40px]">{{ $feature->description }}</p>
            </div>
        </article>
    @empty
        <p class="col-span-3 text-center text-gray-500">Add feature copy in the admin under Home page → Features.</p>
    @endforelse

</section>
