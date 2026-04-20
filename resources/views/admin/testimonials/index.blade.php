@extends('layouts.admin')

@section('title', 'Testimonials')

@section('heading', 'Testimonials')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <p class="text-sm text-gray-600">Slides on the home page “What Say Clients” section. Order by sort order.</p>
        <a href="{{ route('admin.testimonials.create') }}" class="rounded-lg bg-primary px-5 py-2.5 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
            Add testimonial
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gradient-to-r from-ink to-[#111a35] font-heading text-xs font-bold uppercase tracking-wide text-white">
                    <tr>
                        <th class="px-4 py-3">Avatar</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">★</th>
                        <th class="px-4 py-3">Sort</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($testimonials as $row)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="h-12 w-12 rounded-full border border-gray-200 bg-cover bg-center"
                                     style="background-image: url('{{ $row->avatarUrl() }}')"></div>
                            </td>
                            <td class="max-w-[200px] px-4 py-3 font-medium text-ink">{{ $row->name }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $row->role }}</td>
                            <td class="px-4 py-3">{{ $row->rating }}</td>
                            <td class="px-4 py-3">{{ $row->sort_order }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                <a href="{{ route('admin.testimonials.edit', $row) }}" class="font-semibold text-primary hover:underline">Edit</a>
                                <form action="{{ route('admin.testimonials.destroy', $row) }}" method="POST" class="ml-3 inline" onsubmit="return confirm('Delete this testimonial?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center text-gray-500">
                                No testimonials. <a href="{{ route('admin.testimonials.create') }}" class="font-semibold text-primary hover:underline">Add one</a> or run <code class="font-mono text-xs">php artisan db:seed --class=TestimonialSeeder</code>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
