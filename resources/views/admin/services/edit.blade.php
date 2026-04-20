@extends('layouts.admin')

@section('title', 'Edit service')

@section('heading', 'Edit service')

@section('content')
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-5 text-white">
            <h2 class="font-heading text-lg font-bold uppercase tracking-wide">Edit service</h2>
            <p class="mt-1 text-sm text-white/70">Leave image fields empty to keep current files.</p>
        </div>
        <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" class="space-y-6 px-6 py-8">
            @csrf
            @method('PUT')
            @include('admin.services._form', ['service' => $service])

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="rounded-lg bg-primary px-8 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                    Save
                </button>
                <a href="{{ route('admin.services.index') }}" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-wide text-ink hover:bg-gray-50">Back</a>
            </div>
        </form>
    </div>
@endsection
