<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate verification | Trans-World Security</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: '#ee1a28', navy: '#1a1f6e', ink: '#0b0f1e' },
                    fontFamily: { sans: ['Georgia', 'serif'], heading: ['Oswald', 'sans-serif'] },
                },
            },
        };
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-[#f4f6f9] py-12 font-sans text-ink">
    <div class="mx-auto max-w-3xl px-4">
        <div class="overflow-hidden rounded-3xl border border-[#e5e7eb] bg-white shadow-xl">
            <div class="bg-gradient-to-r from-ink to-[#151a42] px-10 py-12 text-center text-white">
                <p class="font-heading text-sm uppercase tracking-[0.35em] text-white/70">Certificate of completion</p>
                <h1 class="mt-4 font-heading text-3xl font-bold md:text-4xl">{{ $certificate->course_title_snapshot }}</h1>
                <p class="mt-6 text-lg text-white/85">Awarded to</p>
                <p class="mt-2 font-heading text-3xl font-semibold">{{ $certificate->student_name }}</p>
            </div>
            <div class="grid gap-6 px-10 py-10 md:grid-cols-2">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wide text-gray-500">Serial number</p>
                    <p class="mt-1 font-mono text-lg">{{ $certificate->serial_number }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wide text-gray-500">Issued</p>
                    <p class="mt-1 text-lg">{{ $certificate->issued_at->format('F j, Y') }}</p>
                </div>
            </div>
            <div class="border-t border-gray-100 px-10 py-8 text-center text-sm text-gray-600">
                This digital credential was issued by Trans-World Security School of Management and Security.
            </div>
        </div>

        <p class="mt-8 text-center text-sm text-gray-600">
            <a href="{{ url('/') }}" class="font-semibold text-primary hover:underline">Return to website</a>
        </p>
    </div>
</body>
</html>
