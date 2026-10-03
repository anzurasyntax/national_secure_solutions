<section class="relative overflow-hidden bg-white py-24 sm:py-32">
    
    {{-- Decorative backgrounds --}}
    <div class="absolute inset-y-0 left-0 w-1/2 rounded-r-[100px] bg-gray-50/50"></div>
    <div class="absolute -left-40 top-40 h-96 w-96 rounded-full bg-primary/5 blur-3xl"></div>
    
    <div class="relative mx-auto grid w-full max-w-[1440px] grid-cols-1 items-center gap-16 px-5 sm:px-8 lg:grid-cols-2 lg:px-12 xl:px-16">
        
        {{-- Left: Image & Badge --}}
        <div class="relative">
            <div class="group relative overflow-hidden rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] ring-1 ring-gray-900/5">
                <img src="{{ asset($aboutPage->hero_image_path ?: 'img/about_us.jpg') }}" alt="About National Secure Solutions" class="w-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-tr from-black/20 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
            </div>
            
            {{-- Floating Experience Badge --}}
            <div class="absolute -bottom-8 -right-8 hidden rounded-2xl bg-[#080B12] p-8 shadow-2xl lg:block">
                <div class="flex items-center gap-6">
                    <div class="grid h-16 w-16 place-items-center rounded-xl bg-white/10 text-primary">
                        <svg class="h-8 w-8 fill-current" viewBox="0 0 24 24"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                    </div>
                    <div>
                        <p class="font-heading text-4xl font-black text-white">100%</p>
                        <p class="mt-1 font-heading text-xs font-bold uppercase tracking-widest text-primary">Commitment</p>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Right: Content --}}
        <div class="lg:pl-8">
            <div class="mb-6 flex items-center gap-3">
                <span class="h-px w-10 bg-primary"></span>
                <p class="font-heading text-xs font-bold uppercase tracking-[0.3em] text-primary">About Our Company</p>
            </div>
            
            <h2 class="mb-8 font-heading text-3xl font-bold uppercase tracking-tight text-gray-900 sm:text-4xl lg:text-[42px] lg:leading-[1.1]">
                {{ $aboutPage->brand_title }}
            </h2>
            
            <div class="mb-10 font-sans text-base leading-relaxed text-gray-600 sm:text-lg sm:leading-loose [&_p]:mb-4 [&_p:last-child]:mb-0">
                {!! $aboutPage->brand_intro !!}
            </div>
            
            <div class="space-y-8 border-t border-gray-100 pt-8">
                
                <article class="group flex items-start gap-6">
                    <div class="grid h-16 w-16 shrink-0 place-items-center rounded-xl bg-gray-50 text-gray-400 ring-1 ring-gray-900/5 transition-colors duration-300 group-hover:bg-primary group-hover:text-white">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-heading text-xl font-bold uppercase tracking-wide text-gray-900 group-hover:text-primary transition-colors">{{ $aboutPage->mission_title }}</h3>
                        <div class="mt-3 font-sans text-sm leading-relaxed text-gray-600 [&_p]:mb-2 [&_p:last-child]:mb-0">
                            {!! $aboutPage->mission_body !!}
                        </div>
                    </div>
                </article>
                
                <article class="group flex items-start gap-6">
                    <div class="grid h-16 w-16 shrink-0 place-items-center rounded-xl bg-gray-50 text-gray-400 ring-1 ring-gray-900/5 transition-colors duration-300 group-hover:bg-primary group-hover:text-white">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-heading text-xl font-bold uppercase tracking-wide text-gray-900 group-hover:text-primary transition-colors">{{ $aboutPage->vision_title }}</h3>
                        <div class="mt-3 font-sans text-sm leading-relaxed text-gray-600 [&_p]:mb-2 [&_p:last-child]:mb-0">
                            {!! $aboutPage->vision_body !!}
                        </div>
                    </div>
                </article>
                
            </div>
            
            <div class="mt-10">
                <a href="{{ route('about') }}" class="group inline-flex items-center gap-4 bg-primary px-8 py-4 font-heading text-xs font-bold uppercase tracking-widest text-white transition hover:bg-gray-900">
                    Learn More About Us
                    <span class="transition-transform duration-300 group-hover:translate-x-1">→</span>
                </a>
            </div>
            
        </div>
        
    </div>
</section>
