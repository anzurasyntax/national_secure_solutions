@extends('layouts.student-app')

@section('title', 'Dashboard')

@section('student_content')
    @php($user = auth()->user())
    @if (! $user->avatar_path)
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4 rounded-xl border border-primary/40 bg-red-50 px-4 py-3 sm:px-6">
            <div class="flex items-start gap-3">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-primary text-white font-bold">!</span>
                <div>
                    <p class="font-semibold text-ink">Set your profile photo</p>
                    <p class="text-sm text-slate-600">Personalize your dashboard and certificates.</p>
                </div>
            </div>
            <a href="{{ route('student.settings', ['tab' => 'profile']) }}"
               class="shrink-0 rounded-lg border border-primary bg-white px-4 py-2 text-sm font-semibold text-primary hover:bg-primary/10">
                Click Here
            </a>
        </div>
    @endif

    <h1 class="font-heading text-3xl font-bold text-ink">Dashboard</h1>

        <div class="mt-8 grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-primary/10">
                    <svg class="h-7 w-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <p class="mt-4 text-3xl font-bold text-ink">{{ $stats['enrolled'] }}</p>
                <p class="mt-1 text-sm font-medium text-slate-600">Enrolled Courses</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-primary/10">
                    <svg class="h-7 w-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                </div>
                <p class="mt-4 text-3xl font-bold text-ink">{{ $stats['active'] }}</p>
                <p class="mt-1 text-sm font-medium text-slate-600">Active Courses</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-primary/10">
                    <svg class="h-7 w-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <p class="mt-4 text-3xl font-bold text-ink">{{ $stats['completed'] }}</p>
                <p class="mt-1 text-sm font-medium text-slate-600">Completed Courses</p>
            </div>
        </div>

        <div class="mt-12 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <h2 class="font-heading text-xl font-bold text-ink">Continue learning</h2>
                <a href="{{ route('student.enrolled') }}" class="text-sm font-semibold text-primary hover:underline">View all enrolled</a>
            </div>
            @if (count($progressRows) === 0)
                <p class="mt-6 rounded-xl border border-dashed border-slate-200 bg-slate-50 px-6 py-12 text-center text-slate-600">
                    You are not enrolled in any courses yet.
                    <a href="{{ route('courses.index') }}" class="font-semibold text-primary hover:underline">Browse courses</a>
                </p>
            @else
                <ul class="mt-6 divide-y divide-slate-100">
                    @foreach ($progressRows as $row)
                        @php($course = $row['course'])
                        <li class="flex flex-wrap items-center justify-between gap-4 py-4 first:pt-0">
                            <div class="min-w-0">
                                <p class="font-semibold text-ink">{{ $course->title }}</p>
                                <p class="mt-1 text-sm text-slate-600">{{ $row['done'] }}/{{ $row['total'] }} modules · {{ $row['percent'] }}%</p>
                            </div>
                            <a href="{{ route('student.courses.learn', $course) }}"
                               class="inline-flex rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white shadow-sm hover:opacity-90">
                                Open course
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        @if ($certificates->isNotEmpty())
            <div class="mt-10">
                <h2 class="font-heading text-xl font-bold text-ink">Certificates</h2>
                <ul class="mt-4 space-y-2">
                    @foreach ($certificates as $cert)
                        <li class="flex flex-wrap items-center justify-between gap-4 rounded-xl border border-slate-100 bg-white px-4 py-3 shadow-sm">
                            <span class="text-slate-700"><strong class="text-ink">{{ $cert->course_title_snapshot }}</strong> — {{ $cert->issued_at->format('M j, Y') }}</span>
                            <a href="{{ route('certificates.verify', $cert->verify_token) }}" target="_blank" class="text-sm font-semibold text-primary hover:underline">View / download</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
@endsection
