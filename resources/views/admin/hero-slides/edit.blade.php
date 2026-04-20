@extends('layouts.admin')

@section('title', 'Edit hero slide')

@section('heading', 'Edit hero slide')

@section('content')
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-5 text-white">
            <h2 class="font-heading text-lg font-bold uppercase tracking-wide">Edit slide</h2>
            <p class="mt-1 text-sm text-white/70">Replacing the image uploads a new file under <span class="font-mono text-xs">public/img/hero/</span> and updates the stored path.</p>
        </div>

        <form method="POST" action="{{ route('admin.hero-slides.update', $slide) }}" enctype="multipart/form-data" class="space-y-8 px-6 py-8">
            @csrf
            @method('PUT')
            @include('admin.hero-slides._form', ['slide' => $slide])

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="rounded-lg bg-primary px-8 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                    Save changes
                </button>
                <a href="{{ route('admin.hero-slides.index') }}" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-wide text-ink hover:bg-gray-50">
                    Back to list
                </a>
            </div>
        </form>
    </div>
@endsection
