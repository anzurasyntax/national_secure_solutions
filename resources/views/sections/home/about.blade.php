<section class="mx-auto grid max-w-[80%] h-screen grid-cols-1 items-center gap-12 px-4 py-16 lg:grid-cols-2">
    <div class="relative">
        <img src="{{ asset($aboutPage->hero_image_path ?: 'img/about_us.jpg') }}" alt="National Secure Solutions" class="w-full rounded object-cover shadow-lg">
    </div>
    <div>
        <h2 class="font-heading text-[43px] font-bold text-[#1c1c25]">{{ $aboutPage->brand_title }}</h2>
        <span class="my-4 block h-[3px] w-20 bg-primary"></span>
        <div class="mb-8 text-[20px] leading-[40px] text-gray-500 [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->brand_intro !!}</div>
        <div class="space-y-6">
            <article class="flex gap-5">
                <div class="shrink-0">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary text-white">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                            <polyline points="7,12 10,15 17,9" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="font-heading text-[27px] font-bold text-[#1c1c25]">{{ $aboutPage->mission_title }}</h3>
                    <div class="leading-[35px] text-[20px] text-gray-500 [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->mission_body !!}</div>
                </div>
            </article>
            <article class="flex gap-5">
                <div class="shrink-0">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary text-white">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                            <polyline points="7,12 10,15 17,9" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h3 class="font-heading text-[27px] font-bold text-[#1c1c25]">{{ $aboutPage->vision_title }}</h3>
                    <div class="leading-[35px] text-[20px] text-gray-500 [&_p]:mb-3 [&_p:last-child]:mb-0">{!! $aboutPage->vision_body !!}</div>
                </div>
            </article>
        </div>
    </div>
</section>
