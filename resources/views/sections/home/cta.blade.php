@php($cta = $homeCta ?? \App\Models\HomeCta::content())

<section
    id="cta"
    class="relative overflow-hidden bg-primary py-20 text-white"
>
    {{-- Decorative background elements --}}
    <div class="absolute inset-0 bg-[url('{{ $cta->backgroundImageUrl() }}')] bg-cover bg-center bg-no-repeat opacity-20 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-red-900/90 to-primary/80"></div>
    <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
    <div class="absolute -bottom-20 -left-20 h-64 w-64 rounded-full bg-black/10 blur-3xl"></div>

    <div class="relative z-10 mx-auto max-w-[1440px] px-5 sm:px-8 xl:px-12">
        <div class="flex flex-col items-start justify-between gap-10 lg:flex-row lg:items-center">
            
            <div class="max-w-3xl">
                <div class="mb-4 flex items-center gap-3">
                    <span class="h-px w-10 bg-white/50"></span>
                    <p class="font-heading text-xs font-bold uppercase tracking-[0.3em] text-white/80">
                        {{ $cta->subheading }}
                    </p>
                </div>
                <h2 class="font-heading text-3xl font-black uppercase tracking-tight text-white sm:text-4xl lg:text-5xl lg:leading-tight">
                    {{ $cta->headlineWithPhone($siteSetting->phone) }}
                </h2>
            </div>
            
            <div class="shrink-0">
                <a href="{{ $cta->button_url }}"
                   class="group relative inline-flex items-center gap-4 overflow-hidden rounded-full bg-white px-10 py-5 font-heading text-sm font-bold uppercase tracking-widest text-primary shadow-xl transition-transform hover:-translate-y-1">
                    
                    <span class="relative z-10">{{ $cta->button_label }}</span>
                    
                    <span class="relative z-10 transition-transform duration-300 group-hover:translate-x-1">→</span>
                    
                    <div class="absolute inset-0 z-0 bg-gray-50 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                </a>
            </div>

        </div>
    </div>
</section>
