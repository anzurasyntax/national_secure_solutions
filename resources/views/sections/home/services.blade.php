<section class="mx-auto max-w-[80%] px-24 py-16">

    <!-- Header -->
    <div class="mb-14 text-center">
        <p class="font-heading text-sm font-semibold uppercase tracking-[3px] text-primary">What We Do</p>
        <h2 class="font-heading text-[38px] font-bold text-[#1c1c25]">Our Services</h2>
        <span class="mx-auto mt-4 block h-[4px] w-14 bg-primary rounded-xl"></span>
    </div>

    <!-- Cards Grid -->
    <div class="flex items-start gap-8">

        <!-- Card 1: Security Systems -->
        <article class="group relative flex flex-col w-full bg-white shadow-[0_10px_30px_rgba(0,0,0,0.08)] rounded-xl overflow-hidden after:block after:h-[7px] after:w-full after:bg-primary">
            <!-- Image wrapper: NO overflow-hidden here so icon shows fully -->
            <div class="relative rounded-t-xl h-[290px]">
                <!-- Inner clip: only clips the image + overlay, not the icon -->
                <div class="absolute inset-0 rounded-t-xl overflow-hidden">
                    <img src="{{ asset('img/service1.png') }}"
                         alt="Security Systems"
                         class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <!-- Sliding overlay -->
                    <div class="absolute inset-x-0 bottom-0 h-full
                                translate-y-full group-hover:translate-y-0
                                transition-transform duration-500 ease-in-out
                                bg-gradient-to-t from-black/80 via-black/50 to-black/10
                                backdrop-blur-[2px]">
                    </div>
                </div>
                <!-- Floating Icon — outside the clipped div so it shows fully -->
                <div class="absolute -bottom-[31px] left-1/2 -translate-x-1/2 z-20 flex h-[80px] w-[80px] items-center justify-center rounded-full bg-white shadow-[0_4px_16px_rgba(0,0,0,0.12)]">
                    <img src="{{ asset('img/service_icon1.png') }}" alt="" class="w-10 h-10">
                </div>
            </div>
            <div class="flex flex-1 flex-col items-center px-7 pb-7 pt-14 text-center">
                <h3 class="font-heading text-[28px] font-extrabold text-[#1c1c25]">Security Systems</h3>
                <span class="mx-auto mt-2 mb-4 block h-[4px] w-14 bg-primary rounded-xl"></span>
                <p class="text-[20px] leading-[1.85] text-gray-500 mb-5">Advanced security systems with real-time alerts and remote monitoring.</p>
                <a href="#" class="mt-auto text-lg font-bold text-primary border-b border-primary pb-[2px] tracking-wide hover:opacity-70 transition-opacity">Read More</a>
            </div>
        </article>

        <!-- Card 2: Major Event Security (CENTER) -->
        <article class="group relative flex flex-col w-full bg-white shadow-[0_20px_50px_rgba(0,0,0,0.13)] rounded-xl overflow-hidden after:block after:h-[7px] after:w-full after:bg-primary scale-[1.04] origin-top">
            <div class="relative rounded-t-xl h-[340px]">
                <div class="absolute inset-0 rounded-t-xl overflow-hidden">
                    <img src="{{ asset('img/service2.png') }}"
                         alt="Major Event Security"
                         class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-x-0 bottom-0 h-full
                                translate-y-full group-hover:translate-y-0
                                transition-transform duration-500 ease-in-out
                                bg-gradient-to-t from-black/80 via-black/50 to-black/10
                                backdrop-blur-[2px]">
                    </div>
                </div>
                <div class="absolute -bottom-[31px] left-1/2 -translate-x-1/2 z-20 flex h-[80px] w-[80px] items-center justify-center rounded-full bg-white shadow-[0_4px_16px_rgba(0,0,0,0.12)]">
                    <img src="{{ asset('img/service_icon2.png') }}" alt="" class="w-10 h-10">
                </div>
            </div>
            <div class="flex flex-1 flex-col items-center px-7 pb-14 pt-14 text-center">
                <h3 class="font-heading text-[28px] font-extrabold text-[#1c1c25]">Major Event Security</h3>
                <span class="mx-auto mt-2 mb-4 block h-[4px] w-14 bg-primary rounded-xl"></span>
                <p class="text-[20px] leading-[1.85] text-gray-500 mb-5">Expert security for major events: safety, crowd control, emergency response.</p>
                <a href="#" class="mt-auto text-lg font-bold text-primary border-b border-primary pb-[2px] tracking-wide hover:opacity-70 transition-opacity">Read More</a>
            </div>
        </article>

        <!-- Card 3: Bodyguard Services -->
        <article class="group relative flex flex-col w-full bg-white shadow-[0_10px_30px_rgba(0,0,0,0.08)] rounded-xl overflow-hidden after:block after:h-[7px] after:w-full after:bg-primary">
            <div class="relative rounded-t-xl h-[290px]">
                <div class="absolute inset-0 rounded-t-xl overflow-hidden">
                    <img src="{{ asset('img/service3.png') }}"
                         alt="Bodyguard Services"
                         class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-x-0 bottom-0 h-full
                                translate-y-full group-hover:translate-y-0
                                transition-transform duration-500 ease-in-out
                                bg-gradient-to-t from-black/80 via-black/50 to-black/10
                                backdrop-blur-[2px]">
                    </div>
                </div>
                <div class="absolute -bottom-[31px] left-1/2 -translate-x-1/2 z-20 flex h-[80px] w-[80px] items-center justify-center rounded-full bg-white shadow-[0_4px_16px_rgba(0,0,0,0.12)]">
                    <img src="{{ asset('img/service_icon3.png') }}" alt="" class="w-10 h-10">
                </div>
            </div>
            <div class="flex flex-1 flex-col items-center px-7 pb-7 pt-14 text-center">
                <h3 class="font-heading text-[28px] font-extrabold text-[#1c1c25]">Bodyguard Services</h3>
                <span class="mx-auto mt-2 mb-4 block h-[4px] w-14 bg-primary rounded-xl"></span>
                <p class="text-[20px] leading-[1.85] text-gray-500 mb-5">Efficient Bodyguard Services for reliable protection and safety assurance.</p>
                <a href="#" class="mt-auto text-lg font-bold text-primary border-b border-primary pb-[2px] tracking-wide hover:opacity-70 transition-opacity">Read More</a>
            </div>
        </article>

    </div>
</section>
