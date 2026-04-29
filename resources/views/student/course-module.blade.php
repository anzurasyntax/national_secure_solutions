@extends('layouts.student-app')

@section('title', $module->title)

@section('student_content')
    <div class="max-w-4xl">
        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">
            <a href="{{ route('student.enrolled') }}" class="text-primary hover:underline">Enrolled Courses</a>
            /
            <a href="{{ route('student.courses.learn', $course) }}" class="text-primary hover:underline">{{ $course->title }}</a>
        </p>

        <h1 class="mt-4 font-heading text-3xl font-bold text-ink">{{ $module->title }}</h1>

        @php($materials = $module->materialsList())

        @if (count($materials))
            <div class="mt-8 space-y-10">
                @foreach ($materials as $mat)
                    @if ($mat['type'] === 'video')
                        <div class="overflow-hidden rounded-2xl bg-black">
                            <video controls preload="metadata" class="w-full">
                                <source src="{{ asset($mat['path']) }}">
                                Your browser does not support embedded videos.
                            </video>
                        </div>
                    @elseif ($mat['type'] === 'image')
                        <figure class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
                            <img src="{{ asset($mat['path']) }}" alt="{{ $mat['name'] }}" class="mx-auto max-h-[70vh] w-full object-contain" loading="lazy">
                            @if ($mat['name'])
                                <figcaption class="border-t border-slate-200 bg-white px-4 py-2 text-center text-xs text-slate-600">{{ $mat['name'] }}</figcaption>
                            @endif
                        </figure>
                    @elseif ($mat['type'] === 'ppt')
                        @php
                            $slideUrls = collect($mat['slides'] ?? [])
                                ->filter(fn ($p) => is_string($p) && $p !== '')
                                ->map(fn ($p) => asset($p))
                                ->values()
                                ->all();
                        @endphp
                        @if (count($slideUrls))
                            <div class="rounded-2xl border border-slate-200 bg-slate-900 p-4 shadow-sm"
                                 data-ppt-viewer
                                 data-slides="{{ e(json_encode($slideUrls)) }}">
                                <div class="relative flex aspect-[16/10] max-h-[min(70vh,560px)] items-center justify-center overflow-hidden rounded-xl bg-black">
                                    <img src="{{ $slideUrls[0] }}" alt="" class="max-h-full max-w-full object-contain"
                                         data-ppt-slide-img>
                                </div>
                                <div class="mt-4 flex flex-wrap items-center justify-between gap-3">
                                    <button type="button"
                                            class="rounded-lg border border-slate-600 bg-slate-800 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700"
                                            data-ppt-prev>
                                        Previous slide
                                    </button>
                                    <span class="text-sm font-medium text-slate-300" data-ppt-counter></span>
                                    <button type="button"
                                            class="rounded-lg border border-slate-600 bg-slate-800 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700"
                                            data-ppt-next>
                                        Next slide
                                    </button>
                                </div>
                                @if ($mat['name'])
                                    <p class="mt-3 text-center text-xs text-slate-400">{{ $mat['name'] }}</p>
                                @endif
                            </div>
                        @else
                            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                                <h3 class="font-heading text-lg font-bold text-ink">Presentation</h3>
                                @if ($mat['name'])
                                    <p class="mt-1 text-sm text-slate-600">{{ $mat['name'] }}</p>
                                @endif
                                <p class="mt-3 text-sm text-slate-600">
                                    Slide images were not generated on the server (LibreOffice may be missing). You can open the file in the browser if your site is publicly reachable, or download it.
                                </p>
                                <div class="mt-4 flex flex-wrap gap-3">
                                    <a href="{{ asset($mat['path']) }}" download
                                       class="inline-flex rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white hover:opacity-90">
                                        Download presentation
                                    </a>
                                </div>
                                <div class="mt-6 aspect-[16/10] min-h-[20rem] w-full overflow-hidden rounded-xl border border-slate-200 bg-slate-100">
                                    <iframe
                                        title="Presentation preview"
                                        class="h-full min-h-[20rem] w-full"
                                        loading="lazy"
                                        src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(url(asset($mat['path']))) }}"></iframe>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        @elseif ($module->video_url)
            <div class="mt-8 aspect-video overflow-hidden rounded-2xl bg-black">
                <iframe src="{{ $module->video_url }}" class="h-full w-full" title="Video" allowfullscreen loading="lazy"></iframe>
            </div>
            <p class="mt-2 text-xs text-slate-500">Legacy URL-based video for older modules.</p>
        @endif

        @if ($module->body)
            <div class="prose prose-neutral prose-p:text-slate-600 mt-10 max-w-none">{!! $module->body !!}</div>
        @endif

        <div class="mt-12 flex flex-wrap gap-4">
            @if (! $isDone)
                <form method="POST" action="{{ route('student.courses.module.complete', [$course, $module]) }}">
                    @csrf
                    <button type="submit"
                            class="rounded-lg bg-primary px-6 py-4 text-sm font-bold uppercase tracking-wide text-white shadow-sm hover:opacity-90">
                        Mark module complete
                    </button>
                </form>
            @else
                <span class="inline-flex items-center rounded-lg bg-emerald-50 px-6 py-4 text-sm font-bold uppercase tracking-wide text-emerald-900">
                    Completed
                </span>
            @endif

            <a href="{{ route('student.courses.learn', $course) }}"
               class="inline-flex items-center rounded-lg border border-slate-300 px-6 py-4 text-sm font-bold uppercase tracking-wide text-ink hover:bg-slate-50">
                Back to outline
            </a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-ppt-viewer]').forEach(function (root) {
                var raw = root.getAttribute('data-slides');
                if (!raw) return;
                var slides;
                try {
                    slides = JSON.parse(raw);
                } catch (e) {
                    return;
                }
                if (!slides || !slides.length) return;

                var img = root.querySelector('[data-ppt-slide-img]');
                var prevBtn = root.querySelector('[data-ppt-prev]');
                var nextBtn = root.querySelector('[data-ppt-next]');
                var counter = root.querySelector('[data-ppt-counter]');
                if (!img || !prevBtn || !nextBtn || !counter) return;

                var idx = 0;
                function render() {
                    img.src = slides[idx];
                    counter.textContent = (idx + 1) + ' / ' + slides.length;
                    prevBtn.disabled = idx <= 0;
                    nextBtn.disabled = idx >= slides.length - 1;
                    prevBtn.classList.toggle('opacity-40', idx <= 0);
                    nextBtn.classList.toggle('opacity-40', idx >= slides.length - 1);
                }
                prevBtn.addEventListener('click', function () {
                    if (idx > 0) {
                        idx--;
                        render();
                    }
                });
                nextBtn.addEventListener('click', function () {
                    if (idx < slides.length - 1) {
                        idx++;
                        render();
                    }
                });
                render();
            });
        });
    </script>
@endpush
