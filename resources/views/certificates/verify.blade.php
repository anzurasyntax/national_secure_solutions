<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate verification | National Secure Solutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: #fff !important; padding: 0 !important; }
            .certificate-wrap { box-shadow: none !important; border: 1px solid #d7dbe7 !important; }
        }
    </style>
</head>
<body class="min-h-screen bg-[#f4f6f9] py-10 font-sans text-slate-700">
    <div class="mx-auto max-w-5xl px-4">
        <div class="no-print mb-5 flex flex-wrap items-center justify-between gap-3">
            <a href="{{ url('/') }}" class="inline-flex items-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                Back to website
            </a>
            <button type="button" onclick="window.print()"
                    class="inline-flex items-center rounded-md bg-[#0f1f4a] px-5 py-2.5 text-sm font-semibold text-white hover:opacity-95">
                Download / Print Certificate
            </button>
        </div>

        <div class="certificate-wrap overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
            <div class="grid min-h-[640px] md:grid-cols-[170px_minmax(0,1fr)]">
                <div class="flex items-center justify-center bg-[#111a49] px-5 py-10">
                    <p class="rotate-180 text-center text-3xl font-bold uppercase tracking-[0.24em] text-white [writing-mode:vertical-rl]">
                        Certificate Of Completion
                    </p>
                </div>

                <div class="px-8 py-8 md:px-10 md:py-10">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">National Secure Solutions</p>
                            <h1 class="mt-2 text-2xl font-bold text-slate-900 md:text-3xl">{{ $certificate->course_title_snapshot }}</h1>
                        </div>
                        <div class="rounded-lg border border-slate-200 px-3 py-2 text-right">
                            <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Credential ID</p>
                            <p class="font-mono text-xs text-slate-800">{{ $certificate->serial_number }}</p>
                        </div>
                    </div>

                    <div class="mt-16">
                        <p class="text-sm text-slate-600">This is to certify that</p>
                        <p class="mt-2 border-b-2 border-dashed border-slate-300 pb-2 text-3xl font-bold text-slate-900 md:text-4xl">
                            {{ $certificate->student_name }}
                        </p>
                    </div>

                    <div class="mt-10">
                        <p class="text-sm leading-7 text-slate-600">
                            has successfully completed the training requirements and assessments for
                            <span class="font-semibold text-slate-900">{{ $certificate->course_title_snapshot }}</span>.
                        </p>
                    </div>

                    <div class="mt-12 grid gap-6 border-t border-slate-200 pt-6 sm:grid-cols-2">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Issued Date</p>
                            <p class="mt-1 text-base font-semibold text-slate-900">{{ $certificate->issued_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Issued By</p>
                            <p class="mt-1 text-base font-semibold text-slate-900">Authorized Signature</p>
                        </div>
                    </div>

                    <div class="mt-12 border-t border-slate-200 pt-6">
                        <img src="{{ $siteSetting->logoUrl() }}"
                             alt="{{ config('app.name') }}"
                             class="h-16 w-auto object-contain">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
