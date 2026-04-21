@extends('layouts.admin')

@section('title', 'Edit course')
@section('heading', 'Edit course')

@section('content')
    <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-8 rounded-xl border border-gray-200 bg-white p-8 shadow-sm">
        @csrf
        @method('PUT')
        @include('admin.courses._form', compact('course'))

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.courses.index') }}" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-gray-700 hover:bg-gray-50">Cancel</a>
            <button type="submit" class="rounded-lg bg-primary px-6 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 hover:bg-red-700">Update course</button>
        </div>
    </form>

    <div class="mt-8 rounded-xl border border-gray-100 bg-gray-50 px-6 py-4 text-sm text-gray-700">
        <a href="{{ route('admin.courses.modules.index', $course) }}" class="font-semibold text-primary hover:underline">Manage modules for this course →</a>
    </div>
@endsection
