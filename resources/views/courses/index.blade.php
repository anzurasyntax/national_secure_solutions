@extends('layouts.app')

@section('title', 'Online Courses | National Secure Solutions')

@section('content')
    @include('sections.header', ['pageTitle' => 'Online Courses'])

    <div class="mx-auto mb-28 max-w-[90%] px-6 py-10">
        <div class="mb-8">
            <h1 class="font-heading text-3xl font-bold text-ink md:text-4xl">Online courses</h1>
            <p class="mt-2 max-w-3xl text-base text-[#797979]">
                Tap a course to view the full syllabus and details. Use Add to cart to check out securely after you sign in or register.
            </p>
        </div>

        @include('admin.partials.flash')

        @if ($courses->isEmpty())
            <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 px-6 py-16 text-center text-gray-600">
                No published courses yet. Please check back soon.
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($courses as $course)
                    @php
                        $durHrs = $course->duration_minutes ? max(1, (int) round($course->duration_minutes / 60)) : null;
                    @endphp
                    <article
                        class="course-card group flex cursor-pointer flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition hover:border-primary/30 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-primary/40"
                        tabindex="0"
                        data-detail-url="{{ route('courses.show', $course) }}"
                        role="link"
                        aria-label="View {{ $course->title }}"
                    >
                        @if ($course->image_path)
                            <div class="aspect-[5/3] overflow-hidden bg-gray-100">
                                <img src="{{ asset($course->image_path) }}" alt="" class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]">
                            </div>
                        @else
                            <div class="aspect-[5/3] bg-gradient-to-br from-ink to-navy"></div>
                        @endif
                        <div class="flex flex-1 flex-col p-4">
                            <h2 class="font-heading text-base font-bold leading-snug text-ink line-clamp-2">{{ $course->title }}</h2>
                            @if ($course->summary)
                                <p class="mt-1.5 line-clamp-2 text-xs leading-relaxed text-[#797979]">{{ $course->summary }}</p>
                            @endif
                            <div class="mt-2 flex flex-wrap items-center gap-1.5 text-[11px] font-medium text-[#797979]">
                                <span class="rounded-full bg-gray-100 px-2 py-0.5 text-ink">{{ $course->modules_count }} modules</span>
                                @if ($durHrs)
                                    <span>{{ $durHrs }} hr{{ $durHrs === 1 ? '' : 's' }}</span>
                                @endif
                            </div>
                            <div class="mt-3 flex items-center justify-between gap-2 border-t border-gray-100 pt-3">
                                <p class="font-heading text-lg font-bold text-primary">
                                    {{ number_format((float) $course->price, 2) }} {{ $course->currency }}
                                </p>
                                @auth
                                    <a href="{{ route('courses.checkout', $course) }}"
                                       onclick="event.stopPropagation()"
                                       class="inline-flex shrink-0 items-center rounded-lg bg-primary px-3 py-2 font-heading text-[10px] font-bold uppercase tracking-[0.12em] text-white shadow-sm shadow-primary/20 transition hover:bg-red-700">
                                        Add to cart
                                    </a>
                                @else
                                    <button type="button"
                                            data-open-checkout-auth
                                            data-checkout-url="{{ route('courses.checkout', $course) }}"
                                            onclick="event.stopPropagation()"
                                            class="inline-flex shrink-0 items-center rounded-lg bg-primary px-3 py-2 font-heading text-[10px] font-bold uppercase tracking-[0.12em] text-white shadow-sm shadow-primary/20 transition hover:bg-red-700">
                                        Add to cart
                                    </button>
                                @endauth
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>

    @guest
        @include('courses.partials.auth-checkout-modal')
    @endguest
@endsection
