@extends('layouts.admin')

@section('title', 'New hero slide')

@section('heading', 'New hero slide')

@section('content')
    @php($nextOrder = (\App\Models\HeroSlide::query()->max('sort_order') ?? 0) + 1)

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-5 text-white">
            <h2 class="font-heading text-lg font-bold uppercase tracking-wide">Add slide</h2>
            <p class="mt-1 text-sm text-white/70">Upload saves to <span class="font-mono text-xs">public/img/hero/</span> and stores the path like <span class="font-mono text-xs">img/hero/your-file.jpg</span>.</p>
        </div>

        <form method="POST" action="{{ route('admin.hero-slides.store') }}" enctype="multipart/form-data" class="space-y-8 px-6 py-8">
            @csrf
            @include('admin.hero-slides._form', ['slide' => null, 'nextOrder' => $nextOrder])

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="rounded-lg bg-primary px-8 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                    Create slide
                </button>
                <a href="{{ route('admin.hero-slides.index') }}" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-wide text-ink hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
