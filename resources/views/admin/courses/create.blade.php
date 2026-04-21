@extends('layouts.admin')

@section('title', 'Add course')
@section('heading', 'Add course')

@section('content')
    <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 rounded-xl border border-gray-200 bg-white p-8 shadow-sm">
        @csrf
        @include('admin.courses._form', ['course' => null])

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.courses.index') }}" class="rounded-lg border border-gray-300 px-6 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-gray-700 hover:bg-gray-50">Cancel</a>
            <button type="submit" class="rounded-lg bg-primary px-6 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 hover:bg-red-700">Save course</button>
        </div>
    </form>
@endsection
