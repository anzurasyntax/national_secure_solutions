@props([
    'service',
    'featured' => false,
    'showBody' => false,
    'showDividerAfter' => false,
])

@php
    $imgH = $featured ? 'h-[290px] sm:h-[320px] lg:h-[340px]' : 'h-[240px] sm:h-[270px] lg:h-[290px]';
    $wrapPadding = $featured ? 'pb-14' : 'pb-7';
    $cardWrap = $featured
        ? 'shadow-[0_20px_50px_rgba(0,0,0,0.13)] scale-[1.04] origin-top'
        : 'shadow-[0_10px_30px_rgba(0,0,0,0.08)]';
@endphp

<article id="service-{{ $service->id }}" class="group relative flex w-full flex-col overflow-hidden rounded-xl bg-white {{ $cardWrap }} after:block after:h-[7px] after:w-full after:bg-primary">
    <div class="relative rounded-t-xl {{ $imgH }}">
        <div class="absolute inset-0 rounded-t-xl overflow-hidden">
            <img src="{{ asset($service->image_path) }}"
                 alt="{{ $service->title }}"
                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
            <div class="absolute inset-x-0 bottom-0 h-full translate-y-full bg-gradient-to-t from-black/80 via-black/50 to-black/10 backdrop-blur-[2px] transition-transform duration-500 ease-in-out group-hover:translate-y-0"></div>
        </div>
        <div class="absolute -bottom-7 left-1/2 z-20 flex h-14 w-14 -translate-x-1/2 items-center justify-center rounded-full bg-white shadow-[0_4px_16px_rgba(0,0,0,0.12)] sm:-bottom-[31px] sm:h-[80px] sm:w-[80px]">
            <img src="{{ asset($service->icon_path) }}" alt="" class="h-8 w-8 object-contain sm:h-10 sm:w-10">
        </div>
    </div>
    <div class="flex flex-1 flex-col items-center px-5 pt-11 text-center sm:px-7 sm:pt-14 {{ $wrapPadding }}">
        <h3 class="font-heading text-2xl font-extrabold text-[#1c1c25] sm:text-[28px]">{{ $service->title }}</h3>
        <span class="mx-auto mb-4 mt-2 block h-[4px] w-14 rounded-xl bg-primary"></span>
        <p class="mb-5 text-base leading-8 text-gray-500 sm:text-[20px] sm:leading-[1.85]">{{ $service->excerpt }}</p>
        @if ($showBody && filled($service->body))
            <div class="mb-5 max-w-prose text-left text-[15px] leading-relaxed text-gray-600 sm:text-[17px]">{!! $service->body !!}</div>
        @endif
        <a href="{{ route('services') }}#service-{{ $service->id }}" class="mt-auto border-b border-primary pb-[2px] text-lg font-bold tracking-wide text-primary transition-opacity hover:opacity-70">Read More</a>
    </div>
    @if ($showDividerAfter)
        <span class="absolute right-0 top-1/2 hidden h-12 w-[2px] -translate-y-1/2 bg-red-600 lg:block"></span>
    @endif
</article>
