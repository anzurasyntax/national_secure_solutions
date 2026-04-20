@extends('layouts.admin')

@section('title', 'Hero Slider')

@section('heading', 'Hero Slider')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <p class="text-sm text-gray-600">Slides appear on the home page hero. Images are stored under <code class="rounded bg-gray-100 px-1 text-xs">public/</code> (same paths as created from this panel).</p>
        <a href="{{ route('admin.hero-slides.create') }}" class="rounded-lg bg-primary px-5 py-2.5 font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
            Add slide
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gradient-to-r from-ink to-[#111a35] font-heading text-xs font-bold uppercase tracking-wide text-white">
                    <tr>
                        <th class="px-4 py-3">Preview</th>
                        <th class="px-4 py-3">Order</th>
                        <th class="px-4 py-3">Headline</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($slides as $slide)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="h-14 w-24 shrink-0 overflow-hidden rounded-lg border border-gray-200 bg-gray-100 bg-cover bg-center"
                                     style="background-image: url('{{ $slide->imageUrl() }}')"></div>
                            </td>
                            <td class="px-4 py-3 font-medium text-ink">{{ $slide->sort_order }}</td>
                            <td class="max-w-md px-4 py-3 text-gray-700">{{ \Illuminate\Support\Str::limit($slide->headline, 80) }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="font-semibold text-primary hover:underline">Edit</a>
                                <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Delete this slide?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-12 text-center text-gray-500">
                                No slides yet. <a href="{{ route('admin.hero-slides.create') }}" class="font-semibold text-primary hover:underline">Create the first slide</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
