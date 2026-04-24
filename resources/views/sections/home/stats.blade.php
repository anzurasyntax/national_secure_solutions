<section
    id="stats"
    class="relative py-16 text-white overflow-hidden"
    style="background-color: #070E20; background-image: url('{{ asset('img/stat_bg.png') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat;"
>
    <div class="absolute inset-0" style="background-color: rgba(211, 211, 211, 0.15);"></div>

    <div class="relative z-10 mx-auto max-w-[1170px] px-4">
        <div class="grid grid-cols-2 md:grid-cols-4">

            @forelse ($homeStats as $stat)
                <article class="flex flex-col items-center justify-center py-8 px-6 text-center {{ ! $loop->last ? 'relative' : '' }}">
                    <h3 class="text-4xl font-extrabold leading-tight tracking-tight sm:text-[52px]">
                        <span data-counter="{{ $stat->value }}">0</span>{{ $stat->suffix }}
                    </h3>
                    <p class="mt-2 text-[13px] font-bold uppercase tracking-[2px] text-gray-300">{{ $stat->heading }}</p>
                    @if (! $loop->last)
                        <span class="absolute right-0 top-1/2 hidden h-12 w-[2px] -translate-y-1/2 bg-red-600 md:block"></span>
                    @endif
                </article>
            @empty
                <div class="col-span-full py-12 text-center text-gray-400">Configure stats in Admin → Home page → Stats.</div>
            @endforelse

        </div>
    </div>
</section>
