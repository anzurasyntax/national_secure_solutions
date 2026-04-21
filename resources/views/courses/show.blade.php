@extends('layouts.app')

@section('title', $course->title.' | Online Courses')

@section('content')
    @include('sections.header', ['pageTitle' => $course->title])

    <div class="mx-auto max-w-[1170px] px-6 py-12">
        <div class="grid gap-10 lg:grid-cols-12">
            <div class="lg:col-span-8">
                @if ($course->image_path)
                    <div class="mb-8 overflow-hidden rounded-2xl border border-gray-200 bg-gray-100">
                        <img src="{{ asset($course->image_path) }}" alt="" class="max-h-[420px] w-full object-cover">
                    </div>
                @endif

                <h1 class="font-heading text-4xl font-bold text-ink">{{ $course->title }}</h1>

                @if ($course->summary)
                    <p class="mt-4 text-xl text-[#444]">{{ $course->summary }}</p>
                @endif

                @if ($course->description)
                    <div class="prose prose-neutral mt-8 max-w-none whitespace-pre-wrap text-[#797979]">{{ $course->description }}</div>
                @endif

                <div class="mt-10">
                    <h2 class="font-heading text-2xl font-bold text-ink">Modules</h2>
                    <ol class="mt-4 list-decimal space-y-3 pl-6 text-[#797979]">
                        @forelse ($course->modules as $index => $module)
                            <li>
                                <span class="font-semibold text-ink">{{ $module->title }}</span>
                            </li>
                        @empty
                            <li class="list-none text-gray-500">Modules will appear here once the instructor publishes them.</li>
                        @endforelse
                    </ol>
                </div>
            </div>

            <aside class="lg:col-span-4">
                @php
                    $enrolled = auth()->check() && auth()->user()->courseEnrollments()->where('course_id', $course->id)->exists();
                    $isAdmin = auth()->check() && auth()->user()->is_admin;
                @endphp
                <div class="sticky top-28 space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-sm uppercase tracking-wide text-gray-500">Price</p>
                    <p class="font-heading text-4xl font-bold text-primary">
                        {{ number_format((float) $course->price, 2) }} {{ $course->currency }}
                    </p>

                    @if ($enrolled)
                        <a href="{{ route('student.courses.learn', $course) }}"
                           class="block w-full rounded-lg bg-navy py-4 text-center font-heading text-xs font-bold uppercase tracking-[0.15em] text-white transition hover:bg-[#151a66]">
                            Continue learning
                        </a>
                    @elseif ($isAdmin)
                        <a href="{{ route('student.courses.learn', $course) }}"
                           class="block w-full rounded-lg bg-navy py-4 text-center font-heading text-xs font-bold uppercase tracking-[0.15em] text-white transition hover:bg-[#151a66]">
                            Preview course modules
                        </a>
                        <p class="text-xs text-gray-500">Administrators can review content without checkout.</p>
                    @else
                        <a href="{{ route('courses.checkout', $course) }}"
                           class="block w-full rounded-lg bg-primary py-4 text-center font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                            Enrol &amp; pay
                        </a>
                    @endif

                    <p class="text-xs text-gray-500">
                        After payment, students set a password (or log in if the email already exists) to access modules and earn a certificate of completion.
                    </p>
                </div>
            </aside>
        </div>
    </div>
@endsection
