<section class="relative w-full overflow-hidden py-20 text-white"
         style="background-image: url('{{ asset('img/testimonial_bg.png') }}'); background-size: cover; background-position: center;">
    <!-- Dark overlay -->
    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative z-10 mx-auto max-w-[80%] px-4">

        <!-- Header row: title left-center, arrows top-right -->
        <div class="mb-10 flex items-start justify-between">
            <div class="flex-1 text-center">
                <p class="font-heading text-sm font-bold uppercase tracking-[3px] text-primary">Testimonials</p>
                <h2 class="font-heading text-[42px] font-bold text-white">What Say Clients</h2>
                <span class="mx-auto mt-4 block h-[3px] w-16 bg-primary"></span>
            </div>
            <!-- Prev / Next arrows — top right -->
            <div class="flex shrink-0 items-center gap-3 pt-2">
                <button onclick="testimonialPrev()"
                        class="text-primary transition-opacity hover:opacity-60">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button onclick="testimonialNext()"
                        class="text-primary transition-opacity hover:opacity-60">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Slide wrapper -->
        <div class="relative mx-auto max-w-[80%]">

            <!-- Slides -->
            <div id="tSlides" class="relative">

                <!-- Slide 1 -->
                <div class="t-slide relative rounded-xl bg-white px-16 py-10 text-center shadow-2xl transition-all duration-500">
                    <!-- Avatar — overlapping left edge -->
                    <div class="absolute -left-9 top-1/2 -translate-y-1/2">
                        <div class="h-[72px] w-[72px] rounded-full border-4 border-yellow-400 overflow-hidden shadow-lg">
                            <img src="{{ asset('img/profile.png') }}" alt="Paul Vincent" class="h-full w-full object-cover">
                        </div>
                    </div>
                    <!-- Large quote marks bottom-right -->
                    <div class="absolute bottom-6 right-8 text-[80px] font-serif leading-none text-gray-200 select-none">
                         <img src="{{ asset('img/testimonial.png') }}" alt="" style="opacity: 0.2;">
                    </div>

                    <!-- Review text -->
                    <p class="mx-auto max-w-3xl text-[20px] leading-[1.9] text-gray-500">
                        As a property manager, ensuring the safety of our residents is my top priority. Trans-World Security has been an invaluable partner in achieving that goal. Their expertise in security assessments and implementation of state-of-the-art technology has given us peace of mind.
                    </p>
                    <!-- Stars -->
                    <div class="mt-6 flex justify-center gap-1 text-yellow-400 text-4xl">
                        ★★★★★
                    </div>
                    <!-- Name & role -->
                    <h3 class="mt-4 font-heading text-[28px] font-extrabold uppercase text-[#1c1c25]">PAUL VINCENT</h3>
                    <p class="mt-1 text-md font-semibold text-gray-400">Manager</p>
                </div>

                <!-- Slide 2 -->
                <div class="t-slide relative hidden rounded-xl bg-white px-16 py-10 text-center shadow-2xl transition-all duration-500">
                    <div class="absolute -left-9 top-1/2 -translate-y-1/2">
                        <div class="h-[72px] w-[72px] rounded-full border-4 border-yellow-400 overflow-hidden shadow-lg">
                            <img src="{{ asset('img/profile.png') }}" alt="Matt Morgan" class="h-full w-full object-cover">
                        </div>
                    </div>
                    <div class="absolute bottom-6 right-8 text-[80px] font-serif leading-none text-gray-200 select-none">
                         <img src="{{ asset('img/testimonial.png') }}" alt="" style="opacity: 0.2;">
                    </div>
                    <p class="mx-auto max-w-3xl text-[20px] leading-[1.9] text-gray-500">
                        I highly recommend Trans-World Security for their exceptional security services. Their team demonstrated utmost professionalism and vigilance throughout our partnership. A truly reliable security company.
                    </p>
                    <div class="mt-6 flex justify-center gap-1 text-yellow-400 text-4xl">★★★★★</div>
                    <h3 class="mt-4 font-heading text-[28px] font-extrabold uppercase text-[#1c1c25]">MATT MORGAN</h3>
                    <p class="mt-1 text-md font-semibold text-gray-400">CEO</p>
                </div>

                <!-- Slide 3 -->
                <div class="t-slide relative hidden rounded-xl bg-white px-16 py-10 text-center shadow-2xl transition-all duration-500">
                    <div class="absolute -left-9 top-1/2 -translate-y-1/2">
                        <div class="h-[72px] w-[72px] rounded-full border-4 border-yellow-400 overflow-hidden shadow-lg">
                            <img src="{{ asset('img/profile.png') }}" alt="Angel Jones" class="h-full w-full object-cover">
                        </div>
                    </div>
                    <div class="absolute bottom-6 right-8 text-[80px] font-serif leading-none text-gray-200 select-none">
                         <img src="{{ asset('img/testimonial.png') }}" alt="" style="opacity: 0.2;">
                    </div>
                    <p class="mx-auto max-w-3xl text-[20px] leading-[1.9] text-gray-500">
                        Choosing Trans-World Security was one of the best decisions we made for our business. Their team is highly trained and professional, providing comprehensive security solutions tailored to our needs.
                    </p>
                    <div class="mt-6 flex justify-center gap-1 text-yellow-400 text-4xl">★★★★★</div>
                    <h3 class="mt-4 font-heading text-[28px] font-extrabold uppercase text-[#1c1c25]">ANGEL JONES</h3>
                    <p class="mt-1 text-md font-semibold text-gray-400">Finance Manager</p>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    let tCurrent = 0;
    const tSlides = document.querySelectorAll('.t-slide');
    const tTotal = tSlides.length;

    function showSlide(index) {
        tSlides.forEach((s, i) => {
            s.classList.toggle('hidden', i !== index);
        });
        tCurrent = index;
    }

    function testimonialNext() {
        showSlide((tCurrent + 1) % tTotal);
    }

    function testimonialPrev() {
        showSlide((tCurrent - 1 + tTotal) % tTotal);
    }

    showSlide(0);
</script>
