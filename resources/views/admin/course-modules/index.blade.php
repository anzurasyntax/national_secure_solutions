@extends('layouts.admin')

@section('title', 'Modules · '.$course->title)
@section('heading', 'Modules')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-sm text-gray-600">{{ $course->title }}</p>
            <p class="text-xs text-gray-500">Define the order students follow in the learner experience.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.courses.index') }}" class="rounded-lg border border-gray-300 px-5 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-gray-700 hover:bg-gray-50">Back to courses</a>
            <a href="{{ route('admin.courses.modules.create', $course) }}"
               class="rounded-lg bg-primary px-5 py-3 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 hover:bg-red-700">
                Add module
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-600">
                <tr>
                    <th class="px-6 py-4">Order</th>
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($modules as $module)
                    <tr>
                        <td class="px-6 py-4">{{ $module->sort_order }}</td>
                        <td class="px-6 py-4 font-semibold text-ink">{{ $module->title }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.courses.modules.edit', [$course, $module]) }}" class="text-primary hover:underline">Edit</a>
                            <span class="text-gray-300">|</span>
                            <form action="{{ route('admin.courses.modules.destroy', [$course, $module]) }}" method="POST" class="inline" onsubmit="return confirm('Delete this module?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-16 text-center text-gray-600">No modules yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
