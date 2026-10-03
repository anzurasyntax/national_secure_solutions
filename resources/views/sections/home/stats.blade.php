<section
    id="stats"
    class="relative overflow-hidden bg-[#080B12] py-24 text-white lg:py-32"
>
    {{-- Background image overlay --}}
    <div class="absolute inset-0 bg-[url('{{ asset('img/stat_bg.png') }}')] bg-cover bg-center bg-no-repeat opacity-20 mix-blend-luminosity"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#080B12] via-[#080B12]/80 to-[#080B12]"></div>
    
    <div class="relative z-10 mx-auto max-w-[1440px] px-5 sm:px-8 xl:px-12">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4 md:gap-4 lg:gap-8">
            
            @forelse ($homeStats as $stat)
                <article class="group relative flex flex-col items-center justify-center overflow-hidden rounded-2xl border border-white/5 bg-white/[0.02] p-8 text-center backdrop-blur-sm transition-all duration-500 hover:-translate-y-2 hover:border-primary/30 hover:bg-white/[0.04] sm:p-10 shadow-2xl">
                    
                    {{-- Hover glow --}}
                    <div class="absolute -top-24 left-1/2 h-48 w-48 -translate-x-1/2 rounded-full bg-primary/20 blur-3xl transition-opacity duration-500 opacity-0 group-hover:opacity-100"></div>
                    
                    <div class="relative z-10 mb-6 grid h-16 w-16 place-items-center rounded-xl bg-gradient-to-br from-[#10141D] to-[#080B12] text-primary shadow-inner ring-1 ring-white/10 transition-transform duration-500 group-hover:scale-110 group-hover:ring-primary/50">
                        {{-- Generic icon for stat, you can replace with DB icon if available --}}
                        <svg class="h-7 w-7 fill-current drop-shadow-md" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    
                    <h3 class="relative z-10 font-heading text-4xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl drop-shadow-lg">
                        <span data-counter="{{ $stat->value }}">0</span><span class="text-primary">{{ $stat->suffix }}</span>
                    </h3>
                    
                    <p class="relative z-10 mt-5 font-heading text-[10px] font-bold uppercase tracking-[0.3em] text-white/50 transition-colors group-hover:text-white/80">
                        {{ $stat->heading }}
                    </p>
                    
                    {{-- Bottom active line --}}
                    <div class="absolute bottom-0 left-1/2 h-1 w-0 -translate-x-1/2 bg-gradient-to-r from-transparent via-primary to-transparent transition-all duration-500 group-hover:w-full"></div>
                </article>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-white/20 p-12 text-center text-white/40">
                    <p class="font-sans text-sm font-medium uppercase tracking-widest">Configure stats in Admin → Home page → Stats.</p>
                </div>
            @endforelse
            
        </div>
    </div>
</section>
