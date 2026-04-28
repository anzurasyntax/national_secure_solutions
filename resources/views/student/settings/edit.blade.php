@extends('layouts.student-app')

@section('title', 'Settings')

@section('student_content')
    <h1 class="font-heading text-3xl font-bold text-ink">Settings</h1>

    <div class="mt-8 flex flex-wrap gap-4 border-b border-slate-200">
        <a href="{{ route('student.settings', ['tab' => 'profile']) }}"
           class="relative pb-3 text-sm font-semibold {{ $tab === 'profile' ? 'text-primary after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-full after:bg-primary' : 'text-slate-500 hover:text-ink' }}">
            Profile
        </a>
        <a href="{{ route('student.settings', ['tab' => 'password']) }}"
           class="relative pb-3 text-sm font-semibold {{ $tab === 'password' ? 'text-primary after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-full after:bg-primary' : 'text-slate-500 hover:text-ink' }}">
            Password
        </a>
    </div>

    @if ($errors->any())
        <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($tab === 'profile')
        <form method="POST" action="{{ route('student.settings.profile') }}" enctype="multipart/form-data" class="mt-10 max-w-4xl space-y-8">
            @csrf
            @method('PUT')

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="font-heading text-lg font-bold text-ink">Photos</h2>
                <p class="mt-1 text-sm text-slate-500">Profile photo ~200×200px · Cover ~700×430px recommended.</p>
                <div class="mt-6 grid gap-6 sm:grid-cols-2">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Profile photo</label>
                        <input type="file" name="avatar" accept="image/*"
                               class="mt-2 block w-full text-sm text-slate-700 file:mr-4 file:rounded-lg file:border-0 file:bg-primary file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:opacity-90">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Cover photo</label>
                        <input type="file" name="cover" accept="image/*"
                               class="mt-2 block w-full text-sm text-slate-700 file:mr-4 file:rounded-lg file:border-0 file:bg-primary file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:opacity-90">
                    </div>
                </div>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">First name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" required
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Last name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}"
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                           placeholder="letters, numbers, dash, underscore">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Phone number</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Skill / occupation</label>
                    <input type="text" name="skill_occupation" value="{{ old('skill_occupation', $user->skill_occupation) }}"
                           class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Timezone</label>
                    <select name="timezone"
                            class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                        <option value="">Select timezone</option>
                        @foreach ($timezones as $tz)
                            <option value="{{ $tz }}" {{ old('timezone', $user->timezone) === $tz ? 'selected' : '' }}>{{ $tz }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Display name publicly as</label>
                <input type="text" name="public_display_name" value="{{ old('public_display_name', $user->public_display_name) }}"
                       class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                       placeholder="Shown on certificates / public areas">
                <p class="mt-1 text-xs text-slate-500">If empty, your full name is used.</p>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Biography</label>
                <textarea name="bio" rows="6"
                          class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <button type="submit"
                    class="rounded-lg bg-primary px-8 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-sm hover:opacity-90">
                Update Profile
            </button>
        </form>
    @else
        <form method="POST" action="{{ route('student.settings.password') }}" class="mt-10 max-w-md space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Current password</label>
                <input type="password" name="current_password" required autocomplete="current-password"
                       class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">New password</label>
                <input type="password" name="password" required autocomplete="new-password"
                       class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-slate-600">Confirm new password</label>
                <input type="password" name="password_confirmation" required autocomplete="new-password"
                       class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
            </div>

            <button type="submit"
                    class="rounded-lg bg-primary px-8 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-sm hover:opacity-90">
                Update Password
            </button>
        </form>
    @endif
@endsection
