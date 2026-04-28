@extends('layouts.student-app')

@section('title', $pageTitle)

@section('student_content')
    <h1 class="font-heading text-3xl font-bold text-ink">{{ $pageTitle }}</h1>
    <div class="mt-10 rounded-2xl border border-dashed border-slate-200 bg-white px-8 py-20 text-center shadow-sm">
        <p class="mx-auto max-w-lg text-slate-600">{{ $message }}</p>
    </div>
@endsection
