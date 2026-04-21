@extends('layouts.admin')

@section('title', 'Blog categories')

@section('heading', 'Blog categories')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <p class="text-sm text-gray-600">Used in the blog sidebar and for filtering posts.</p>
        <a href="{{ route('admin.blog-categories.create') }}" class="rounded-lg bg-primary px-5 py-2.5 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
            Add category
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gradient-to-r from-ink to-[#111a35] font-heading text-xs font-bold uppercase tracking-wide text-white">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Sort</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($categories as $cat)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-ink">{{ $cat->name }}</td>
                            <td class="px-4 py-3 font-mono text-xs text-gray-600">{{ $cat->slug }}</td>
                            <td class="px-4 py-3">{{ $cat->sort_order }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.blog-categories.edit', $cat) }}" class="font-semibold text-primary hover:underline">Edit</a>
                                <form action="{{ route('admin.blog-categories.destroy', $cat) }}" method="POST" class="ml-3 inline" onsubmit="return confirm('Delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-gray-500">No categories. <a href="{{ route('admin.blog-categories.create') }}" class="font-semibold text-primary">Add</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
