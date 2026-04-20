<section
    id="why-choose-us"
    class="relative overflow-hidden py-20 text-white"
    style="background-color: #070E20; background-image: url('{{ asset('img/stat_bg.png') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;"
>
    <div class="absolute inset-0" style="background-color: rgba(211, 211, 211, 0.15);"></div>

    <div class="relative z-10 mx-auto max-w-[80%] px-4 text-center">

        <p class="font-heading text-sm font-bold uppercase tracking-[3px] text-primary">Special Offer</p>
        <h2 class="mt-1 font-heading text-[42px] font-extrabold uppercase tracking-wide">WHY CHOOSE US</h2>
        <span class="mx-auto mt-4 block h-[3px] w-16 bg-primary"></span>

        <div class="mt-16 grid grid-cols-1 gap-10 md:grid-cols-3">

            @forelse ($whyChooseItems as $item)
                <article class="flex flex-col items-center px-6 text-center">
                    <div class="mb-7 flex h-20 w-20 items-center justify-center">
                        <img src="{{ asset($item->icon_path) }}" alt="">
                    </div>
                    <h3 class="font-heading text-[28px] font-extrabold uppercase tracking-wide text-white">{{ $item->title }}</h3>
                    <p class="mt-4 text-[20px] font-normal leading-[1.85] text-white">{{ $item->description }}</p>
                </article>
            @empty
                <p class="col-span-full text-center text-white/70">Add content in Admin → Home page → Why Choose Us.</p>
            @endforelse

        </div>
    </div>
</section>
