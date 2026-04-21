@extends('layouts.app')

@section('title', 'Online Courses | Trans-World Security')

@section('content')
    @include('sections.header', ['pageTitle' => 'Online Courses'])

    <div class="mx-auto max-w-[1170px] px-6 py-12">
        <div class="mb-10">
            <h1 class="font-heading text-4xl font-bold text-ink md:text-5xl">Online courses</h1>
            <p class="mt-3 max-w-3xl text-lg text-[#797979]">
                Purchase access to structured modules. After checkout you will create your student login (or sign in if you already have one) and track progress from My learning.
            </p>
        </div>

        @if ($courses->isEmpty())
            <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 px-6 py-16 text-center text-gray-600">
                No published courses yet. Please check back soon.
            </div>
        @else
            <div class="grid gap-8 md:grid-cols-2">
                @foreach ($courses as $course)
                    <article class="flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:shadow-md">
                        @if ($course->image_path)
                            <div class="aspect-[16/9] overflow-hidden bg-gray-100">
                                <img src="{{ asset($course->image_path) }}" alt="" class="h-full w-full object-cover">
                            </div>
                        @else
                            <div class="aspect-[16/9] bg-gradient-to-br from-ink to-navy"></div>
                        @endif
                        <div class="flex flex-1 flex-col p-6">
                            <h2 class="font-heading text-2xl font-bold text-ink">{{ $course->title }}</h2>
                            @if ($course->summary)
                                <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-[#797979]">{{ $course->summary }}</p>
                            @endif
                            <div class="mt-4 flex flex-wrap items-center gap-3 text-sm text-[#797979]">
                                <span class="rounded-full bg-gray-100 px-3 py-1 font-semibold text-ink">{{ $course->modules_count }} modules</span>
                                @if ($course->duration_minutes)
                                    <span>{{ $course->duration_minutes }} min est.</span>
                                @endif
                            </div>
                            <div class="mt-auto flex flex-wrap items-center justify-between gap-4 pt-6">
                                <p class="font-heading text-2xl font-bold text-primary">
                                    {{ number_format((float) $course->price, 2) }} {{ $course->currency }}
                                </p>
                                <a href="{{ route('courses.show', $course) }}"
                                   class="inline-flex items-center rounded-lg bg-primary px-5 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                                    View details
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
@endsection
