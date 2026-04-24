<section class="mx-auto grid max-w-[92%] grid-cols-1 items-center gap-10 px-4 py-12 sm:max-w-[88%] sm:py-14 lg:max-w-[80%] lg:min-h-screen lg:grid-cols-2 lg:gap-12 lg:py-16">
    <div class="relative">
        <img src="{{ asset($aboutPage->hero_image_path ?: 'img/about_us.jpg') }}" alt="National Secure Solutions" class="w-full rounded object-cover shadow-lg">
    </div>
    <div>
        <h2 class="font-heading text-3xl font-bold text-[#1c1c25] sm:text-4xl lg:text-[43px]">{{ $aboutPage->brand_title }}</h2>
        <span class="my-4 block h-[3px] w-20 bg-primary"></span>
        <div class="mb-8 text-base leading-8 text-gray-500 sm:text-lg sm:leading-9 lg:text-[20px] lg:leading-[40px] [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->brand_intro !!}</div>
        <div class="space-y-6">
            <article class="flex gap-4 sm:gap-5">
                <div class="shrink-0">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary text-white sm:h-16 sm:w-16">
                        <svg class="h-6 w-6 sm:h-8 sm:w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                            <polyline points="7,12 10,15 17,9" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="font-heading text-2xl font-bold text-[#1c1c25] sm:text-[27px]">{{ $aboutPage->mission_title }}</h3>
                    <div class="text-base leading-8 text-gray-500 sm:text-lg sm:leading-9 lg:text-[20px] lg:leading-[35px] [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->mission_body !!}</div>
                </div>
            </article>
            <article class="flex gap-4 sm:gap-5">
                <div class="shrink-0">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary text-white sm:h-16 sm:w-16">
                        <svg class="h-6 w-6 sm:h-8 sm:w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                            <polyline points="7,12 10,15 17,9" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="font-heading text-2xl font-bold text-[#1c1c25] sm:text-[27px]">{{ $aboutPage->vision_title }}</h3>
                    <div class="text-base leading-8 text-gray-500 sm:text-lg sm:leading-9 lg:text-[20px] lg:leading-[35px] [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->vision_body !!}</div>
                </div>
            </article>
        </div>
    </div>
</section>
