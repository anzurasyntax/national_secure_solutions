@auth
    @php($user = auth()->user())
    <header class="sticky top-0 z-30 flex items-center justify-between border-b border-slate-200 bg-white px-4 py-4 shadow-sm sm:px-6 lg:px-10">
        <div class="flex min-w-0 flex-1 items-center gap-3 lg:gap-4">
            <button type="button" id="student-sidebar-toggle"
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700 lg:hidden"
                    aria-label="Open menu">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div class="flex items-center gap-3 min-w-0">
                @if ($user->avatarAssetUrl())
                    <img src="{{ $user->avatarAssetUrl() }}" alt="" class="h-12 w-12 shrink-0 rounded-full object-cover ring-2 ring-primary/30">
                @else
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary text-base font-bold text-white ring-2 ring-primary/30">
                        {{ $user->initials() }}
                    </span>
                @endif
                <div class="min-w-0">
                    <p class="text-sm text-slate-500">Hello,</p>
                    <p class="truncate text-lg font-semibold text-ink">{{ $user->displayFullName() }}</p>
                </div>
            </div>
        </div>
        <button type="button" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary hover:bg-primary/20" aria-label="Notifications">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        </button>
    </header>
@endauth
