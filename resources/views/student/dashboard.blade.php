@extends('layouts.app')

@section('title', 'My learning | Trans-World Security')

@section('content')
    @include('sections.header', ['pageTitle' => 'My learning'])

    <div class="mx-auto max-w-[1170px] px-6 py-12">
        @if (session('status'))
            <div class="mb-8 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-900">
                {{ session('status') }}
            </div>
        @endif

        <h1 class="font-heading text-4xl font-bold text-ink">My courses</h1>
        <p class="mt-2 text-[#797979]">Pick up where you left off and download certificates when you finish every module.</p>

        @if ($enrollments->isEmpty())
            <div class="mt-10 rounded-xl border border-dashed border-gray-300 bg-gray-50 px-6 py-16 text-center text-gray-600">
                You are not enrolled in any courses yet.
                <a href="{{ route('courses.index') }}" class="font-semibold text-primary hover:underline">Browse courses</a>
            </div>
        @else
            <div class="mt-10 grid gap-6 md:grid-cols-2">
                @foreach ($enrollments as $enrollment)
                    @php($course = $enrollment->course)
                    @continue(!$course)
                    @php($total = $progress[$course->id]['total'] ?? 0)
                    @php($done = $progress[$course->id]['done'] ?? 0)
                    <article class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h2 class="font-heading text-xl font-bold text-ink">{{ $course->title }}</h2>
                        <p class="mt-2 text-sm text-[#797979]">
                            Progress: {{ $total ? round(($done / $total) * 100) : 0 }}% ({{ $done }}/{{ $total }} modules)
                        </p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('student.courses.learn', $course) }}"
                               class="inline-flex rounded-lg bg-primary px-5 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                                Open course
                            </a>
                            @php($cert = $certificates->firstWhere('course_id', $course->id))
                            @if ($cert)
                                <a href="{{ route('certificates.verify', $cert->verify_token) }}" target="_blank"
                                   class="inline-flex rounded-lg border border-navy px-5 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-navy transition hover:bg-gray-50">
                                    View certificate
                                </a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        @if ($certificates->isNotEmpty())
            <div class="mt-16">
                <h2 class="font-heading text-2xl font-bold text-ink">Certificates</h2>
                <ul class="mt-4 space-y-2 text-[#797979]">
                    @foreach ($certificates as $cert)
                        <li class="flex flex-wrap items-center justify-between gap-4 rounded-lg border border-gray-100 bg-gray-50 px-4 py-3">
                            <span><strong class="text-ink">{{ $cert->course_title_snapshot }}</strong> — {{ $cert->issued_at->format('M j, Y') }}</span>
                            <a href="{{ route('certificates.verify', $cert->verify_token) }}" target="_blank" class="text-sm font-semibold text-primary hover:underline">Verify link</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
