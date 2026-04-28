@extends('layouts.student-app')

@section('title', $module->title)

@section('student_content')
    <div class="max-w-4xl">
        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">
            <a href="{{ route('student.enrolled') }}" class="text-primary hover:underline">Enrolled Courses</a>
            /
            <a href="{{ route('student.courses.learn', $course) }}" class="text-primary hover:underline">{{ $course->title }}</a>
        </p>

        <h1 class="mt-4 font-heading text-3xl font-bold text-ink">{{ $module->title }}</h1>

        @php
            $moduleVideos = collect($module->video_paths ?? [])
                ->filter(fn ($path) => is_string($path) && trim($path) !== '')
                ->values();
        @endphp

        @if ($moduleVideos->isNotEmpty())
            <div class="mt-8 space-y-6">
                @foreach ($moduleVideos as $videoPath)
                    <div class="overflow-hidden rounded-2xl bg-black">
                        <video controls preload="metadata" class="w-full">
                            <source src="{{ asset($videoPath) }}">
                            Your browser does not support embedded videos.
                        </video>
                    </div>
                @endforeach
            </div>
        @elseif ($module->video_url)
            <div class="mt-8 aspect-video overflow-hidden rounded-2xl bg-black">
                <iframe src="{{ $module->video_url }}" class="h-full w-full" title="Video" allowfullscreen loading="lazy"></iframe>
            </div>
            <p class="mt-2 text-xs text-slate-500">Legacy URL-based video for older modules.</p>
        @endif

        @if ($module->body)
            <div class="prose prose-neutral prose-p:text-slate-600 mt-10 max-w-none">{!! $module->body !!}</div>
        @endif

        <div class="mt-12 flex flex-wrap gap-4">
            @if (! $isDone)
                <form method="POST" action="{{ route('student.courses.module.complete', [$course, $module]) }}">
                    @csrf
                    <button type="submit"
                            class="rounded-lg bg-primary px-6 py-4 text-sm font-bold uppercase tracking-wide text-white shadow-sm hover:opacity-90">
                        Mark module complete
                    </button>
                </form>
            @else
                <span class="inline-flex items-center rounded-lg bg-emerald-50 px-6 py-4 text-sm font-bold uppercase tracking-wide text-emerald-900">
                    Completed
                </span>
            @endif

            <a href="{{ route('student.courses.learn', $course) }}"
               class="inline-flex items-center rounded-lg border border-slate-300 px-6 py-4 text-sm font-bold uppercase tracking-wide text-ink hover:bg-slate-50">
                Back to outline
            </a>
        </div>
    </div>
@endsection
