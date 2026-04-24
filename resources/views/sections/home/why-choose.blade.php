<section
    id="why-choose-us"
    class="relative overflow-hidden py-20 text-white"
    style="background-color: #070E20; background-image: url('{{ asset('img/stat_bg.png') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;"
>
    <div class="absolute inset-0" style="background-color: rgba(211, 211, 211, 0.15);"></div>

    <div class="relative z-10 mx-auto max-w-[92%] px-4 text-center sm:max-w-[88%] lg:max-w-[80%]">

        <p class="font-heading text-sm font-bold uppercase tracking-[3px] text-primary">Special Offer</p>
        <h2 class="mt-1 font-heading text-3xl font-extrabold uppercase tracking-wide sm:text-[42px]">WHY CHOOSE US</h2>
        <span class="mx-auto mt-4 block h-[3px] w-16 bg-primary"></span>

        <div class="mt-16 grid grid-cols-1 gap-10 md:grid-cols-3">

            @forelse ($whyChooseItems as $item)
                <article class="flex flex-col items-center px-2 text-center sm:px-6">
                    <div class="mb-5 flex h-14 w-14 items-center justify-center sm:mb-7 sm:h-20 sm:w-20">
                        <img src="{{ asset($item->icon_path) }}" alt="">
                    </div>
                    <h3 class="font-heading text-2xl font-extrabold uppercase tracking-wide text-white sm:text-[28px]">{{ $item->title }}</h3>
                    <p class="mt-3 text-base font-normal leading-8 text-white sm:mt-4 sm:text-[20px] sm:leading-[1.85]">{{ $item->description }}</p>
                </article>
            @empty
                <p class="col-span-full text-center text-white/70">Add content in Admin → Home page → Why Choose Us.</p>
            @endforelse

        </div>
    </div>
</section>
