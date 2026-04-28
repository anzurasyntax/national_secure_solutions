@extends('layouts.student-app')

@section('title', 'Enrolled Courses')

@section('student_content')
    @php
        $countAll = count($allRows);
        $countActive = collect($allRows)->where('active', true)->count();
        $countCompleted = collect($allRows)->where('completed', true)->count();
        $tabs = [
            'enrolled' => ['label' => 'Enrolled Courses', 'count' => $countAll],
            'active' => ['label' => 'Active Courses', 'count' => $countActive],
            'completed' => ['label' => 'Completed Courses', 'count' => $countCompleted],
        ];
    @endphp

    <h1 class="font-heading text-3xl font-bold text-ink">Enrolled Courses</h1>

    <div class="mt-8 flex flex-wrap gap-2 border-b border-slate-200">
        @foreach ($tabs as $key => $meta)
            <a href="{{ route('student.enrolled', ['tab' => $key]) }}"
               class="relative px-4 pb-3 text-sm font-semibold transition {{ $tab === $key ? 'text-primary after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-full after:bg-primary' : 'text-slate-500 hover:text-ink' }}">
                {{ $meta['label'] }} ({{ $meta['count'] }})
            </a>
        @endforeach
    </div>

    <div class="mt-10 space-y-8">
        @forelse ($progressRows as $row)
            @php($course = $row['course'])
            @php($cert = $certificates->get($course->id))
            <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="grid gap-6 md:grid-cols-[240px_1fr]">
                    <div class="aspect-video bg-slate-100 md:aspect-auto md:min-h-[160px]">
                        @if ($course->image_path)
                            <img src="{{ asset($course->image_path) }}" alt="" class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full min-h-[140px] items-center justify-center bg-gradient-to-br from-slate-700 to-slate-900 text-white">
                                <span class="text-sm font-semibold">{{ \Illuminate\Support\Str::limit($course->title, 40) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex gap-1 text-primary">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            @endfor
                        </div>
                        <h2 class="mt-3 font-heading text-xl font-bold text-ink">{{ $course->title }}</h2>
                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2 text-sm text-slate-600">
                            <span>{{ $row['done'] }}/{{ $row['total'] }} lessons</span>
                            <span class="font-semibold text-ink">{{ $row['percent'] }}% Complete</span>
                        </div>
                        <div class="mt-2 h-2 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-primary transition-all" style="width: {{ $row['percent'] }}%"></div>
                        </div>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('student.courses.learn', $course) }}"
                               class="inline-flex rounded-lg bg-primary px-5 py-2.5 text-sm font-semibold text-white hover:opacity-90">
                                Continue course
                            </a>
                            @if ($cert)
                                <a href="{{ route('certificates.verify', $cert->verify_token) }}" target="_blank"
                                   class="inline-flex rounded-lg border-2 border-primary bg-white px-5 py-2.5 text-sm font-semibold text-primary hover:bg-red-50">
                                    Download Certificate
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-xl border border-dashed border-slate-200 bg-white px-6 py-16 text-center text-slate-600">
                No courses in this tab yet.
                <a href="{{ route('courses.index') }}" class="font-semibold text-primary hover:underline">Browse catalog</a>
            </div>
        @endforelse
    </div>
@endsection
