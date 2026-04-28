@extends('layouts.app')

@section('content')
    <div class="min-h-[55vh] bg-[#f4f6f9] py-8 pb-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-[16rem_minmax(0,1fr)] lg:items-start lg:gap-8">
                @include('student.partials.sidebar')

                <div class="min-w-0">
                    @include('student.partials.header')
                    <div class="mt-6">
                        @include('student.partials.flash-session')
                        @yield('student_content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var openBtn = document.getElementById('student-sidebar-toggle');
            var sidebar = document.getElementById('student-sidebar-panel');
            var backdrop = document.getElementById('student-sidebar-backdrop');
            function close() {
                if (!sidebar || !backdrop) return;
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
            function openNav() {
                if (!sidebar || !backdrop) return;
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }
            if (openBtn && sidebar && backdrop) {
                openBtn.addEventListener('click', openNav);
                backdrop.addEventListener('click', close);
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') close();
                });
            }
        });
    </script>
@endpush
