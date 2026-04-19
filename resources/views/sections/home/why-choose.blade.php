<section
    class="relative py-20 text-white overflow-hidden"
    style="background-color: #070E20; background-image: url('{{ asset('img/stat_bg.png') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;"
>
    <!-- Dark overlay -->
    <div class="absolute inset-0" style="background-color: rgba(211, 211, 211, 0.15);"></div>

    <div class="relative z-10 mx-auto max-w-[80%] px-4 text-center">

        <!-- Header -->
        <p class="font-heading text-sm font-bold uppercase tracking-[3px] text-primary">Special Offer</p>
        <h2 class="font-heading text-[42px] font-extrabold uppercase tracking-wide mt-1">WHY CHOOSE US</h2>
        <span class="mx-auto mt-4 block h-[3px] w-16 bg-primary"></span>

        <!-- Cards -->
        <div class="mt-16 grid grid-cols-1 gap-10 md:grid-cols-3">

            <!-- Item 1 -->
            <article class="flex flex-col items-center text-center px-6">
                <!-- Icon -->
                <div class="mb-7 flex h-20 w-20 items-center justify-center">
                    <img src="{{ asset('img/chooseUs_icon1.png') }}" alt="">
                </div>
                <h3 class="font-heading text-[28px] font-extrabold uppercase tracking-wide text-white">40 YEARS OF EXPERIENCES</h3>
                <p class="mt-4 font-normal text-[20px] leading-[1.85] text-white">Benefit from over 40 years of trusted expertise in safeguarding businesses and properties.</p>
            </article>

            <!-- Item 2 -->
            <article class="flex flex-col items-center text-center px-6">
                <div class="mb-7 flex h-20 w-20 items-center justify-center">
                    <img src="{{ asset('img/chooseUs_icon1.png') }}" alt="">
                </div>
                <h3 class="font-heading text-[28px] font-extrabold uppercase tracking-wide text-white">SELF MOTIVATED GUARDS</h3>
                <p class="mt-4 font-normal text-[20px] leading-[1.85] text-white">Our self-motivated guards are dedicated to ensuring your safety with unwavering commitment.</p>
            </article>

            <!-- Item 3 -->
            <article class="flex flex-col items-center text-center px-6">
                <div class="mb-7 flex h-20 w-20 items-center justify-center">
                    <img src="{{ asset('img/chooseUs_icon1.png') }}" alt="">
                </div>
                <h3 class="font-heading text-[28px] font-extrabold uppercase tracking-wide text-white">LATEST SECURITY TECHNIQUES</h3>
                <p class="mt-4 font-normal text-[20px] leading-[1.85] text-white">Utilizing the latest security techniques to keep you protected with advanced technology.</p>
            </article>

        </div>
    </div>
</section>
