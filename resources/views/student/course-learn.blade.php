@extends('layouts.app')

@section('title', $course->title.' | My learning')

@section('content')
    @include('sections.header', ['pageTitle' => $course->title])

    <div class="mx-auto mb-28 max-w-[80%] px-6 py-12">
        @if (session('status'))
            <div class="mb-8 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-900">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-wide text-gray-500"><a href="{{ route('student.dashboard') }}" class="text-primary hover:underline">My learning</a> / Course</p>
                <h1 class="font-heading text-4xl font-bold text-ink">{{ $course->title }}</h1>
            </div>
            @if ($certificate)
                <a href="{{ route('certificates.verify', $certificate->verify_token) }}" target="_blank"
                   class="rounded-lg border border-navy px-4 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-navy transition hover:bg-gray-50">
                    View certificate
                </a>
            @endif
        </div>

        @php
            $total = $course->modules->count();
            $doneCount = count($completedIds);
            $pct = $total ? round(($doneCount / $total) * 100) : 0;
        @endphp

        <div class="mt-8 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <p class="text-sm text-[#797979]">{{ $doneCount }} of {{ $total }} modules complete</p>
                <span class="font-heading text-lg font-bold text-primary">{{ $pct }}%</span>
            </div>
            <div class="mt-3 h-2 overflow-hidden rounded-full bg-gray-100">
                <div class="h-full rounded-full bg-primary transition-all" style="width: {{ $pct }}%"></div>
            </div>
        </div>

        <ol class="mt-10 space-y-4">
            @foreach ($course->modules as $module)
                @php($isDone = in_array($module->id, $completedIds, true))
                <li class="rounded-2xl border {{ $isDone ? 'border-green-200 bg-green-50/40' : 'border-gray-200 bg-white' }} p-6 shadow-sm">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wide text-gray-500">Module {{ $loop->iteration }}</p>
                            <h2 class="mt-1 font-heading text-xl font-bold text-ink">{{ $module->title }}</h2>
                            @if ($isDone)
                                <span class="mt-2 inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-900">Completed</span>
                            @endif
                        </div>
                        <a href="{{ route('student.courses.module', [$course, $module]) }}"
                           class="inline-flex rounded-lg bg-navy px-5 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white transition hover:bg-[#151a66]">
                            {{ $isDone ? 'Review' : 'Start' }}
                        </a>
                    </div>
                </li>
            @endforeach
        </ol>

        @if ($course->modules->isEmpty())
            <p class="mt-8 text-center text-gray-600">Modules are not available yet.</p>
        @endif
    </div>
@endsection
