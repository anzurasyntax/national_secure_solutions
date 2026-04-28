@auth
    @php($nav = $activeNav ?? '')
    <div id="student-sidebar-backdrop" class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-sm transition lg:hidden hidden" aria-hidden="true"></div>

    <aside id="student-sidebar-panel"
           class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col border-r border-slate-200 bg-white shadow-xl transition-transform duration-200 lg:relative lg:inset-auto lg:z-auto lg:h-auto lg:w-full lg:translate-x-0 lg:rounded-2xl lg:border lg:border-slate-200 lg:shadow-sm">
        <div class="flex h-16 items-center border-b border-slate-100 px-4">
            <a href="{{ route('student.dashboard') }}" class="truncate text-lg font-bold text-ink">My learning</a>
        </div>
        <nav class="flex-1 overflow-y-auto px-3 py-4">
            <ul class="space-y-1">
                @foreach (config('student_nav.main', []) as $navItem)
                    @php($linkActive = $nav === $navItem['key'])
                    <li>
                        <a href="{{ route($navItem['route']) }}"
                           class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition {{ $linkActive ? 'bg-primary text-white shadow-sm' : 'text-slate-700 hover:bg-primary/10' }}">
                            @include('student.partials.nav-icon', ['name' => $navItem['icon'], 'active' => $linkActive])
                            <span>{{ $navItem['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="my-4 border-t border-slate-100"></div>
            <ul class="space-y-1">
                @foreach (config('student_nav.bottom', []) as $navItem)
                    @php($linkActive = $nav === $navItem['key'])
                    <li>
                        <a href="{{ route($navItem['route']) }}"
                           class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition {{ $linkActive ? 'bg-primary text-white shadow-sm' : 'text-slate-700 hover:bg-primary/10' }}">
                            @include('student.partials.nav-icon', ['name' => $navItem['icon'], 'active' => $linkActive])
                            <span>{{ $navItem['label'] }}</span>
                        </a>
                    </li>
                @endforeach
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit"
                                class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm font-medium text-slate-700 transition hover:bg-red-50 hover:text-red-700">
                            @include('student.partials.nav-icon', ['name' => 'logout', 'active' => false])
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <div class="border-t border-slate-100 p-4">
            <a href="{{ route('home') }}" class="text-xs font-medium text-primary hover:underline">← Back to website</a>
        </div>
    </aside>
@endauth
