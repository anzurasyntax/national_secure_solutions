<section
    id="why-choose-us"
    class="relative overflow-hidden bg-[#050810] py-24 text-white lg:py-32"
>
    {{-- Decorative grid and glow --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:24px_24px]"></div>
    <div class="absolute left-1/2 top-0 h-96 w-full -translate-x-1/2 bg-[radial-gradient(ellipse_at_top,rgba(255,255,255,0.05),transparent_50%)]"></div>
    
    <div class="relative z-10 mx-auto max-w-[1440px] px-5 text-center sm:px-8 xl:px-12">

        {{-- Header --}}
        <div class="mb-16 flex flex-col items-center justify-center md:mb-24">
            <div class="mb-5 inline-flex items-center gap-3">
                <span class="h-px w-10 bg-primary"></span>
                <p class="font-heading text-xs font-bold uppercase tracking-[0.3em] text-primary">Special Offer</p>
                <span class="h-px w-10 bg-primary"></span>
            </div>
            <h2 class="font-heading text-3xl font-bold uppercase tracking-tight text-white sm:text-4xl md:text-5xl">
                Why Choose Us
            </h2>
        </div>

        <div class="grid grid-cols-1 gap-12 md:grid-cols-3 md:gap-8">

            @forelse ($whyChooseItems as $item)
                <article class="group relative flex flex-col items-center rounded-2xl border border-white/5 bg-white/5 p-8 transition-all duration-500 hover:-translate-y-2 hover:border-primary/20 hover:bg-white/10 sm:p-10">
                    
                    <div class="mb-8 grid h-20 w-20 place-items-center rounded-2xl bg-[#080B12] text-primary shadow-xl ring-1 ring-white/10 transition-transform duration-500 group-hover:scale-110 group-hover:ring-primary/50">
                        <img src="{{ asset($item->icon_path) }}" alt="" class="h-10 w-10 object-contain">
                    </div>
                    
                    <h3 class="mb-4 font-heading text-xl font-bold uppercase tracking-wide text-white group-hover:text-primary transition-colors sm:text-2xl">
                        {{ $item->title }}
                    </h3>
                    
                    <p class="font-sans text-sm leading-relaxed text-white/60 sm:text-base">
                        {{ $item->description }}
                    </p>
                    
                    {{-- Hover line --}}
                    <div class="absolute bottom-0 left-1/2 h-1 w-0 -translate-x-1/2 bg-primary transition-all duration-500 group-hover:w-full rounded-b-2xl"></div>
                </article>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-white/20 p-12 text-center text-white/40">
                    <p class="font-sans text-sm font-medium uppercase tracking-widest">Add content in Admin → Home page → Why Choose Us.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>
