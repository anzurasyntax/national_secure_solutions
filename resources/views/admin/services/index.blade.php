@extends('layouts.admin')

@section('title', 'Services')

@section('heading', 'Services')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <p class="text-sm text-gray-600">Manage services. The three most recently added appear on the home page; this list order uses sort order for the full Services page.</p>
        <a href="{{ route('admin.services.create') }}" class="rounded-lg bg-primary px-5 py-2.5 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
            Add service
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gradient-to-r from-ink to-[#111a35] font-heading text-xs font-bold uppercase tracking-wide text-white">
                    <tr>
                        <th class="px-4 py-3">Image</th>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Sort</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($services as $service)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="h-14 w-20 overflow-hidden rounded-lg border border-gray-200 bg-gray-100 bg-cover bg-center"
                                     style="background-image: url('{{ asset($service->image_path) }}')"></div>
                            </td>
                            <td class="max-w-xs px-4 py-3 font-medium text-ink">{{ $service->title }}</td>
                            <td class="px-4 py-3">{{ $service->sort_order }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                <a href="{{ route('admin.services.edit', $service) }}" class="font-semibold text-primary hover:underline">Edit</a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="ml-3 inline" onsubmit="return confirm('Delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-12 text-center text-gray-500">
                                No services. <a href="{{ route('admin.services.create') }}" class="font-semibold text-primary hover:underline">Add one</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
