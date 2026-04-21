@extends('layouts.app')

@section('title', $module->title.' | '.$course->title)

@section('content')
    @include('sections.header', ['pageTitle' => $module->title])

    <div class="mx-auto max-w-[960px] px-6 py-12">
        <p class="text-xs font-bold uppercase tracking-wide text-gray-500">
            <a href="{{ route('student.dashboard') }}" class="text-primary hover:underline">My learning</a>
            /
            <a href="{{ route('student.courses.learn', $course) }}" class="text-primary hover:underline">{{ $course->title }}</a>
        </p>

        <h1 class="mt-4 font-heading text-4xl font-bold text-ink">{{ $module->title }}</h1>

        @if ($module->video_url)
            <div class="mt-8 aspect-video overflow-hidden rounded-2xl bg-black">
                <iframe src="{{ $module->video_url }}" class="h-full w-full" title="Video" allowfullscreen loading="lazy"></iframe>
            </div>
            <p class="mt-2 text-xs text-gray-500">If the video does not load, your provider may block embedding — open the URL directly.</p>
        @endif

        @if ($module->body)
            <div class="prose prose-neutral mt-10 max-w-none whitespace-pre-wrap text-[#797979]">{{ $module->body }}</div>
        @endif

        <div class="mt-12 flex flex-wrap gap-4">
            @if (! $isDone)
                <form method="POST" action="{{ route('student.courses.module.complete', [$course, $module]) }}">
                    @csrf
                    <button type="submit"
                            class="rounded-lg bg-primary px-6 py-4 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                        Mark module complete
                    </button>
                </form>
            @else
                <span class="inline-flex items-center rounded-lg bg-green-50 px-6 py-4 font-heading text-xs font-bold uppercase tracking-[0.15em] text-green-900">
                    Completed
                </span>
            @endif

            <a href="{{ route('student.courses.learn', $course) }}"
               class="inline-flex items-center rounded-lg border border-gray-300 px-6 py-4 font-heading text-xs font-bold uppercase tracking-[0.15em] text-ink transition hover:bg-gray-50">
                Back to outline
            </a>
        </div>
    </div>
@endsection
