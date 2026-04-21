@extends('layouts.admin')

@section('title', 'Courses')
@section('heading', 'Courses')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <p class="text-sm text-gray-600">Manage catalogue, pricing, and modules.</p>
        <a href="{{ route('admin.courses.create') }}"
           class="rounded-lg bg-primary px-5 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
            Add course
        </a>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-600">
                <tr>
                    <th class="px-6 py-4">Course</th>
                    <th class="px-6 py-4">Price</th>
                    <th class="px-6 py-4">Modules</th>
                    <th class="px-6 py-4">Enrolments</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($courses as $course)
                    <tr>
                        <td class="px-6 py-4 font-semibold text-ink">{{ $course->title }}</td>
                        <td class="px-6 py-4">{{ number_format((float) $course->price, 2) }} {{ $course->currency }}</td>
                        <td class="px-6 py-4">{{ $course->modules_count }}</td>
                        <td class="px-6 py-4">{{ $course->enrollments_count }}</td>
                        <td class="px-6 py-4">
                            @if ($course->is_published)
                                <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-800">Live</span>
                            @else
                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.courses.modules.index', $course) }}" class="text-primary hover:underline">Modules</a>
                            <span class="text-gray-300">|</span>
                            <a href="{{ route('admin.courses.edit', $course) }}" class="text-primary hover:underline">Edit</a>
                            <span class="text-gray-300">|</span>
                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="inline" onsubmit="return confirm('Delete this course and its modules?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-gray-600">No courses yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end">
        <a href="{{ route('admin.course-orders.index') }}" class="text-sm font-semibold text-navy hover:underline">View orders</a>
    </div>
@endsection
