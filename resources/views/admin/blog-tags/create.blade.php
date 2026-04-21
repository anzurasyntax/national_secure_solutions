@extends('layouts.admin')

@section('title', 'New tag')

@section('heading', 'New tag')

@section('content')
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <form method="POST" action="{{ route('admin.blog-tags.store') }}" class="space-y-6 px-6 py-8">
            @csrf
            <div>
                <label class="mb-2 block text-xs font-bold uppercase text-gray-600">Name</label>
                <input type="text" name="name" required value="{{ old('name') }}" class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">
                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-2 block text-xs font-bold uppercase text-gray-600">Slug <span class="font-normal lowercase text-gray-400">(optional)</span></label>
                <input type="text" name="slug" value="{{ old('slug') }}" class="w-full rounded-lg border border-gray-300 px-4 py-3 font-mono text-sm">
                @error('slug')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-2 block text-xs font-bold uppercase text-gray-600">Sort order</label>
                <input type="number" name="sort_order" min="0" value="{{ old('sort_order', 0) }}" class="w-full max-w-[120px] rounded-lg border border-gray-300 px-4 py-3 text-sm">
                @error('sort_order')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="flex gap-3">
                <button type="submit" class="rounded-lg bg-primary px-8 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white hover:bg-red-700">Create</button>
                <a href="{{ route('admin.blog-tags.index') }}" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase text-ink hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
@endsection
