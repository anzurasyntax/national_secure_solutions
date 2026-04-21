@extends('layouts.admin')

@section('title', 'New blog post')

@section('heading', 'New blog post')

@section('content')
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-6 py-5 text-white">
            <h2 class="font-heading text-lg font-bold uppercase tracking-wide">Create post</h2>
            <p class="mt-1 text-sm text-white/70">Images are stored under <code class="font-mono text-xs">public/img/blog/</code>.</p>
        </div>
        <form method="POST" action="{{ route('admin.blog-posts.store') }}" enctype="multipart/form-data" class="space-y-6 px-6 py-8">
            @csrf
            @include('admin.blog-posts._form', ['post' => null])

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="rounded-lg bg-primary px-8 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                    Create
                </button>
                <a href="{{ route('admin.blog-posts.index') }}" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-wide text-ink hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
@endsection
