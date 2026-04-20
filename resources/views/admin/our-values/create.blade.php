@extends('layouts.admin')

@section('title', 'New Our Values card')

@section('heading', 'New Our Values card')

@section('content')
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-5 text-white">
            <h2 class="font-heading text-lg font-bold uppercase tracking-wide">Add value card</h2>
            <p class="mt-1 text-sm text-white/70">Uploaded files are saved under <code class="font-mono text-xs">public/img/our-values/</code>. You can also use an external image URL.</p>
        </div>
        <form method="POST" action="{{ route('admin.our-values.store') }}" enctype="multipart/form-data" class="space-y-6 px-6 py-8">
            @csrf
            @include('admin.our-values._form', ['value' => null])

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="rounded-lg bg-primary px-8 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                    Create
                </button>
                <a href="{{ route('admin.our-values.index') }}" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-wide text-ink hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
@endsection
