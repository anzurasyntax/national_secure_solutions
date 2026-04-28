@extends('layouts.app')

@section('title', $course->title.' | Online Courses')

@section('content')
    @include('sections.header', ['pageTitle' => $course->title])

    @php
        $enrolled = auth()->check() && auth()->user()->courseEnrollments()->where('course_id', $course->id)->exists();
        $isAdmin = auth()->check() && auth()->user()->is_admin;
        $durHrs = $course->duration_minutes ? max(1, (int) round($course->duration_minutes / 60)) : null;

        $learnPoints = collect($course->learning_outcomes ?? [])->filter(fn ($l) => is_string($l) && trim($l) !== '')->values();
        if ($learnPoints->isEmpty()) {
            $learnPoints = $course->modules->pluck('title')->filter()->values();
            if ($learnPoints->isEmpty() && $course->summary) {
                $learnPoints = collect(preg_split('/\r\n|\r|\n/', strip_tags($course->summary)))->filter()->take(12);
            }
        }

        $categories = collect($course->categories ?? [])->filter(fn ($c) => is_string($c) && trim($c) !== '')->values();
        $faqSections = collect($course->faq_sections ?? [])->filter(fn ($f) => is_array($f))->values();

        $formatModuleMins = static function (?int $mins): ?string {
            if ($mins === null || $mins < 1) {
                return null;
            }
            $h = intdiv($mins, 60);
            $m = $mins % 60;
            if ($m === 0) {
                return $h.' hour'.($h === 1 ? '' : 's');
            }

            return sprintf('%dh %02dm', $h, $m);
        };
    @endphp

    <div class="mx-auto mb-28 max-w-[90%] px-6 py-10">
        <nav class="mb-6 flex flex-wrap items-center gap-2 text-sm text-[#797979]" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
            <span aria-hidden="true">/</span>
            <a href="{{ route('courses.index') }}" class="hover:text-primary">Online courses</a>
            <span aria-hidden="true">/</span>
            <span class="font-medium text-ink">{{ $course->title }}</span>
        </nav>

        @include('admin.partials.flash')

        <div class="grid gap-10 lg:grid-cols-12">
            <div class="lg:col-span-8">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-primary">Professional training</p>
                <h1 class="mt-2 font-heading text-3xl font-bold leading-tight text-ink md:text-4xl lg:text-[2.75rem]">
                    {{ $course->title }}
                </h1>

                @if ($categories->isNotEmpty())
                    <p class="mt-3 text-sm text-[#797979]">
                        <span class="font-semibold text-ink">Categories:</span>
                        {{ $categories->implode(', ') }}
                    </p>
                @endif

                <div class="mt-4 flex flex-wrap gap-3 text-sm text-[#797979]">
                    <span class="inline-flex items-center gap-1.5 rounded-full border border-gray-200 bg-gray-50 px-3 py-1">
                        <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @if ($durHrs)
                            {{ $durHrs }} hour{{ $durHrs === 1 ? '' : 's' }} estimated
                        @else
                            Self-paced
                        @endif
                    </span>
                    @if ($course->level_label)
                        <span class="inline-flex items-center rounded-full border border-gray-200 bg-gray-50 px-3 py-1">
                            {{ $course->level_label }}
                        </span>
                    @endif
                    <span class="inline-flex items-center rounded-full border border-gray-200 bg-gray-50 px-3 py-1">
                        {{ $course->modules_count }} modules
                    </span>
                    <span class="inline-flex items-center rounded-full border border-gray-200 bg-gray-50 px-3 py-1">
                        Certificate of completion
                    </span>
                </div>

                @if ($course->image_path)
                    <div class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-gray-100 shadow-sm">
                        <img src="{{ asset($course->image_path) }}" alt="" class="max-h-[380px] w-full object-cover">
                    </div>
                @endif

                <div class="mt-8 flex flex-wrap gap-2 border-b border-gray-200">
                    <button type="button" data-course-tab="info" class="course-detail-tab border-b-2 border-primary px-4 py-3 text-sm font-semibold text-ink">
                        Course Info
                    </button>
                    <button type="button" data-course-tab="reviews" class="course-detail-tab border-b-2 border-transparent px-4 py-3 text-sm font-semibold text-[#797979] hover:text-ink">
                        Reviews
                    </button>
                    <button type="button" data-course-tab="more" class="course-detail-tab border-b-2 border-transparent px-4 py-3 text-sm font-semibold text-[#797979] hover:text-ink">
                        More
                    </button>
                </div>

                <div id="course-panel-info" class="course-panel mt-8">
                    <section>
                        <h2 class="font-heading text-xl font-bold text-ink">About this course</h2>

                        @if ($course->description)
                            <div class="prose prose-neutral prose-p:text-[#555] mt-4 max-w-none whitespace-pre-wrap leading-relaxed">
                                {{ $course->description }}
                            </div>
                        @elseif ($course->summary && $faqSections->isEmpty())
                            <p class="mt-4 text-base leading-relaxed text-[#555]">{{ $course->summary }}</p>
                        @endif

                        @foreach ($faqSections as $faq)
                            @php
                                $_faqHeading = trim((string) ($faq['title'] ?? ''));
                                $_faqBody = trim((string) ($faq['body'] ?? ''));
                            @endphp
                            @if ($_faqHeading !== '' || $_faqBody !== '')
                                <div class="{{ $loop->first ? 'mt-6' : 'mt-8 border-t border-gray-100 pt-8' }}">
                                    @if ($_faqHeading !== '')
                                        <h3 class="font-heading text-lg font-semibold text-ink">{{ $_faqHeading }}</h3>
                                    @endif
                                    @if ($_faqBody !== '')
                                        <div class="prose prose-neutral prose-p:text-[#555] prose-p:leading-relaxed mt-3 max-w-none whitespace-pre-wrap">{{ $_faqBody }}</div>
                                    @endif
                                </div>
                            @endif
                        @endforeach

                        @if (! $course->description && ! $course->summary && $faqSections->isEmpty())
                            <p class="mt-4 text-[#797979]">Course details will appear here once added in the admin panel.</p>
                        @endif
                    </section>

                    @if ($learnPoints->isNotEmpty())
                        <section class="mt-10">
                            <h2 class="font-heading text-xl font-bold text-ink">What you will learn</h2>
                            <ul class="mt-4 grid gap-3 sm:grid-cols-1">
                                @foreach ($learnPoints as $point)
                                    <li class="flex gap-3 rounded-xl border border-gray-100 bg-gray-50/80 px-4 py-3 text-sm text-[#444]">
                                        <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary" aria-hidden="true">
                                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        </span>
                                        <span>{{ $point }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    <section class="mt-10">
                        <h2 class="font-heading text-xl font-bold text-ink">Course content</h2>
                        <p class="mt-2 text-sm text-[#797979]">{{ $course->modules_count }} sections · structured modules with presentations and checkpoints.</p>
                        <div class="mt-6 space-y-2">
                            @if ($course->modules->isEmpty())
                                <p class="rounded-xl border border-dashed border-gray-200 bg-gray-50 px-4 py-8 text-center text-[#797979]">Modules will appear here once published.</p>
                            @else
                                @foreach ($course->modules as $index => $module)
                                    @php
                                        $durLabel = $formatModuleMins($module->duration_minutes);
                                        $outlineRows = $module->lesson_outline;
                                        $hasOutline = is_array($outlineRows) && count($outlineRows) > 0;
                                    @endphp
                                    <details class="group rounded-xl border border-gray-200 bg-white open:border-primary/25 open:shadow-sm">
                                        <summary class="flex cursor-pointer list-none items-center justify-between gap-3 px-4 py-3 font-semibold text-ink marker:content-none [&::-webkit-details-marker]:hidden">
                                            <span class="flex min-w-0 flex-1 items-start gap-3">
                                                <span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-navy/10 text-xs font-bold text-navy">{{ $index + 1 }}</span>
                                                <span class="min-w-0">
                                                    <span class="block">{{ $module->title }}</span>
                                                    @if ($durLabel)
                                                        <span class="mt-0.5 block text-xs font-normal text-[#797979]">Duration: {{ $durLabel }}</span>
                                                    @endif
                                                </span>
                                            </span>
                                            <svg class="h-5 w-5 shrink-0 text-[#797979] transition group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </summary>
                                        <div class="border-t border-gray-100 px-4 py-3 text-sm text-[#555]">
                                            @if ($hasOutline)
                                                <ul class="mb-3 space-y-2 border-b border-gray-50 pb-3">
                                                    @foreach ($outlineRows as $outlineItem)
                                                        @if (trim((string) data_get($outlineItem, 'label')) !== '')
                                                            <li class="flex flex-wrap items-center justify-between gap-2 text-sm">
                                                                <span class="font-medium text-ink">{{ trim((string) data_get($outlineItem, 'label')) }}</span>
                                                                @if (data_get($outlineItem, 'duration_label'))
                                                                    <span class="text-xs text-[#797979]">{{ data_get($outlineItem, 'duration_label') }}</span>
                                                                @endif
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                            @if ($module->body)
                                                <div class="prose prose-sm max-w-none text-[#555]">{!! $module->body !!}</div>
                                            @else
                                                <p class="text-[#797979]">Module materials unlock after enrolment.</p>
                                            @endif
                                        </div>
                                    </details>
                                @endforeach
                            @endif
                        </div>
                    </section>
                </div>

                <div id="course-panel-reviews" class="course-panel mt-8 hidden">
                    <h2 class="font-heading text-xl font-bold text-ink">Student ratings &amp; reviews</h2>
                    <div class="mt-6 rounded-2xl border border-dashed border-gray-200 bg-gray-50/80 px-6 py-14 text-center text-[#797979]">
                        <p class="font-medium text-ink">No reviews yet</p>
                        <p class="mt-2 text-sm">Be the first to complete this course and share your feedback.</p>
                    </div>
                </div>

                <div id="course-panel-more" class="course-panel mt-8 hidden">
                    <h2 class="font-heading text-xl font-bold text-ink">Requirements &amp; materials</h2>

                    @php
                        $reqLines = collect($course->requirements_list ?? [])->filter(fn ($r) => is_string($r) && trim($r) !== '');
                        $matLines = collect($course->material_includes ?? [])->filter(fn ($r) => is_string($r) && trim($r) !== '');
                    @endphp

                    @if ($reqLines->isNotEmpty())
                        <ul class="mt-4 list-disc space-y-2 pl-5 text-sm leading-relaxed text-[#555]">
                            @foreach ($reqLines as $line)
                                <li>{{ $line }}</li>
                            @endforeach
                        </ul>
                    @else
                        <ul class="mt-4 list-disc space-y-2 pl-5 text-sm leading-relaxed text-[#555]">
                            <li>After purchase, you will set a student password (or sign in if you already have an account) from the email we send.</li>
                            <li>Study online at your own pace; progress is saved under
                                @auth
                                    <a href="{{ route('student.dashboard') }}" class="font-semibold text-primary hover:underline">My learning</a>.
                                @else
                                    <span class="font-semibold text-ink">My learning</span> (available after you sign in).
                                @endauth
                            </li>
                            <li>Payment is processed securely. A certificate of completion is issued when you finish all modules.</li>
                        </ul>
                    @endif

                    @if ($matLines->isNotEmpty())
                        <div class="mt-8 rounded-xl border border-gray-200 bg-gray-50 p-6">
                            <h3 class="font-heading text-sm font-bold uppercase tracking-wide text-ink">Material includes</h3>
                            <ul class="mt-3 space-y-2 text-sm text-[#555]">
                                @foreach ($matLines as $line)
                                    <li class="flex gap-2"><span class="text-primary">✓</span> {{ $line }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="mt-8 rounded-xl border border-gray-200 bg-gray-50 p-6">
                            <h3 class="font-heading text-sm font-bold uppercase tracking-wide text-ink">Material includes</h3>
                            <ul class="mt-3 space-y-2 text-sm text-[#555]">
                                <li class="flex gap-2"><span class="text-primary">✓</span> On-demand lessons and structured modules</li>
                                <li class="flex gap-2"><span class="text-primary">✓</span> Interactive learning checkpoints</li>
                                <li class="flex gap-2"><span class="text-primary">✓</span> Progress tracking and certificate</li>
                            </ul>
                        </div>
                    @endif

                    @if ($course->audience)
                        <div class="mt-8 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                            <h3 class="font-heading text-sm font-bold uppercase tracking-wide text-ink">Audience</h3>
                            <p class="mt-3 whitespace-pre-wrap text-sm leading-relaxed text-[#555]">{{ $course->audience }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <aside class="lg:col-span-4">
                <div class="sticky top-28 space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wide text-[#797979]">Course fee</p>
                    <p class="font-heading text-4xl font-bold text-primary">
                        {{ number_format((float) $course->price, 2) }} {{ $course->currency }}
                    </p>
                    @if ($durHrs)
                        <p class="text-sm text-[#797979]">{{ $durHrs }} hour{{ $durHrs === 1 ? '' : 's' }} total · {{ $course->modules_count }} modules</p>
                    @endif
                    @if ($course->detail_last_updated_at)
                        <p class="text-xs text-[#797979]">Last updated {{ $course->detail_last_updated_at->format('j F Y') }}</p>
                    @endif

                    @if ($enrolled)
                        <a href="{{ route('student.courses.learn', $course) }}"
                           class="block w-full rounded-lg bg-navy py-3.5 text-center font-heading text-xs font-bold uppercase tracking-[0.15em] text-white transition hover:bg-[#151a66]">
                            Continue learning
                        </a>
                    @elseif ($isAdmin)
                        <a href="{{ route('student.courses.learn', $course) }}"
                           class="block w-full rounded-lg bg-navy py-3.5 text-center font-heading text-xs font-bold uppercase tracking-[0.15em] text-white transition hover:bg-[#151a66]">
                            Preview course modules
                        </a>
                        <p class="text-xs text-gray-500">Administrators can review content without checkout.</p>
                    @else
                        @auth
                            <a href="{{ route('courses.checkout', $course) }}"
                               class="block w-full rounded-lg bg-primary py-3.5 text-center font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                                Add to cart
                            </a>
                        @else
                            <button type="button"
                                    data-open-checkout-auth
                                    data-checkout-url="{{ route('courses.checkout', $course) }}"
                                    class="block w-full rounded-lg bg-primary py-3.5 text-center font-heading text-xs font-bold uppercase tracking-[0.15em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                                Add to cart
                            </button>
                        @endauth
                    @endif

                    <p class="text-xs leading-relaxed text-gray-500">
                        Secure checkout. After payment, complete your student account (or sign in) to access all modules and your certificate.
                    </p>
                </div>
            </aside>
        </div>
    </div>

    @guest
        @include('courses.partials.auth-checkout-modal')
    @endguest
@endsection

@push('scripts')
<script>
(function () {
    var tabs = document.querySelectorAll('[data-course-tab]');
    var panels = {
        info: document.getElementById('course-panel-info'),
        reviews: document.getElementById('course-panel-reviews'),
        more: document.getElementById('course-panel-more')
    };
    function showPanel(name) {
        Object.keys(panels).forEach(function (key) {
            if (!panels[key]) return;
            panels[key].classList.toggle('hidden', key !== name);
        });
        tabs.forEach(function (btn) {
            var t = btn.getAttribute('data-course-tab');
            var active = t === name;
            btn.classList.toggle('border-primary', active);
            btn.classList.toggle('border-transparent', !active);
            btn.classList.toggle('text-ink', active);
            btn.classList.toggle('text-[#797979]', !active);
        });
    }
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            showPanel(btn.getAttribute('data-course-tab'));
        });
    });
})();
</script>
@endpush
