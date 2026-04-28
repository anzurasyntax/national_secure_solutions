@extends('layouts.student-app')

@section('title', 'My Profile')

@section('student_content')
    <h1 class="font-heading text-3xl font-bold text-ink">My Profile</h1>

    <div class="mt-8 max-w-3xl rounded-2xl border border-slate-200 bg-white shadow-sm">
        <dl class="divide-y divide-slate-100">
            <div class="flex flex-wrap justify-between gap-4 px-6 py-4">
                <dt class="text-sm font-medium text-slate-500">Registration Date</dt>
                <dd class="text-sm font-semibold text-ink">{{ $user->created_at->format('j F Y g:i a') }}</dd>
            </div>
            <div class="flex flex-wrap justify-between gap-4 px-6 py-4">
                <dt class="text-sm font-medium text-slate-500">First Name</dt>
                <dd class="text-sm font-semibold text-ink">{{ $user->first_name ?: '—' }}</dd>
            </div>
            <div class="flex flex-wrap justify-between gap-4 px-6 py-4">
                <dt class="text-sm font-medium text-slate-500">Last Name</dt>
                <dd class="text-sm font-semibold text-ink">{{ $user->last_name ?: '—' }}</dd>
            </div>
            <div class="flex flex-wrap justify-between gap-4 px-6 py-4">
                <dt class="text-sm font-medium text-slate-500">Username</dt>
                <dd class="text-sm font-semibold text-ink">{{ $user->username ?: '—' }}</dd>
            </div>
            <div class="flex flex-wrap justify-between gap-4 px-6 py-4">
                <dt class="text-sm font-medium text-slate-500">Email</dt>
                <dd class="text-sm font-semibold text-ink break-all">{{ $user->email }}</dd>
            </div>
            <div class="flex flex-wrap justify-between gap-4 px-6 py-4">
                <dt class="text-sm font-medium text-slate-500">Phone Number</dt>
                <dd class="text-sm font-semibold text-ink">{{ $user->phone ?: '—' }}</dd>
            </div>
            <div class="flex flex-wrap justify-between gap-4 px-6 py-4">
                <dt class="text-sm font-medium text-slate-500">Skill / Occupation</dt>
                <dd class="text-sm font-semibold text-ink">{{ $user->skill_occupation ?: '—' }}</dd>
            </div>
            <div class="flex flex-wrap justify-between gap-4 px-6 py-4">
                <dt class="text-sm font-medium text-slate-500">Biography</dt>
                <dd class="max-w-md text-sm font-semibold text-ink whitespace-pre-wrap">{{ $user->bio ?: '—' }}</dd>
            </div>
        </dl>
    </div>

    <p class="mt-8">
        <a href="{{ route('student.settings') }}" class="font-semibold text-primary hover:underline">Edit profile in Settings →</a>
    </p>
@endsection
