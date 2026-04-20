@php($cta = $homeCta ?? \App\Models\HomeCta::content())

<section
    id="cta"
    class="relative py-14 text-white overflow-hidden"
    style="background-color: {{ e($cta->background_color) }}; background-image: url('{{ $cta->backgroundImageUrl() }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;"
>
    <!-- Dark overlay -->
    <div class="absolute inset-0" style="background-color: rgba(211, 211, 211, 0.15);"></div>

    <div class="relative z-10 mx-auto flex max-w-[1170px] flex-col items-start justify-between gap-8 px-4 lg:flex-row lg:items-center">

        <div class="max-w-3xl">
            <h2 class="font-heading text-[32px] font-extrabold uppercase leading-tight tracking-wide">
                {{ $cta->headline }}
            </h2>
            <p class="mt-4 text-[13px] font-bold uppercase tracking-[1.5px] text-white/70">
                {{ $cta->subheading }}
            </p>
        </div>

        <a href="{{ $cta->button_url }}"
           class="shrink-0 border-2 border-primary px-10 py-4 font-heading text-sm font-bold uppercase tracking-[2px] text-white transition-all duration-300 hover:bg-primary">
            {{ $cta->button_label }}
        </a>

    </div>
</section>
