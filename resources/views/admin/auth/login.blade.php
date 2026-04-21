<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin sign in | Trans-World Security</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ee1a28',
                        navy: '#1a1f6e',
                        ink: '#0b0f1e',
                    },
                    fontFamily: {
                        sans: ['Open Sans', 'sans-serif'],
                        heading: ['Oswald', 'sans-serif'],
                    },
                },
            },
        };
    </script>
</head>
<body class="min-h-screen bg-gradient-to-br from-ink via-[#0f1730] to-[#1a1f6e] font-sans text-[#797979] flex flex-col items-center justify-center p-6">
    <a href="{{ url('/') }}" class="mb-8 inline-flex items-center gap-3 text-white/90 hover:text-white transition">
        <img src="{{ $siteSetting->logoUrl() }}" alt="{{ config('app.name') }}" class="h-12 w-auto max-w-[220px] object-contain {{ $siteSetting->usesDefaultLogo() ? 'brightness-0 invert' : '' }}">
    </a>

    <div class="w-full max-w-[440px] overflow-hidden rounded-2xl border border-white/10 bg-white shadow-2xl">
        <div class="border-l-4 border-primary bg-gradient-to-r from-ink to-[#111a35] px-8 py-10 text-white">
            <div class="font-heading text-2xl font-bold uppercase tracking-wide">Administrator login</div>
            <div class="mt-2 font-body text-sm text-white/70">Control panel — staff only. Course students use the <a href="{{ route('login') }}" class="font-semibold text-white underline hover:no-underline">main site login</a>.</div>
        </div>

        <div class="px-8 py-10">
            @include('admin.partials.flash')

            <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>

                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-600">Password</label>
                    <input name="password" type="password" required autocomplete="current-password"
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>

                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                    Remember me
                </label>

                <button type="submit" class="w-full rounded-lg bg-primary py-4 font-heading text-xs font-bold uppercase tracking-[0.2em] text-white shadow-md shadow-primary/25 transition hover:bg-red-700">
                    Sign in to admin
                </button>
            </form>

            <p class="mt-8 text-center text-xs text-gray-400">
                <a href="{{ url('/') }}" class="text-primary hover:underline">← Back to website</a>
            </p>
        </div>
    </div>
</body>
</html>
