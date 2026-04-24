
<footer class="font-body">

    <div class="relative bg-ink">

        <!-- Floating Subscribe Card -->
        <div class="relative z-10 flex justify-center -translate-y-8 px-4 sm:-translate-y-[50px] sm:px-6">
            <div class="grid w-full max-w-[95%] grid-cols-1 items-center justify-between gap-6 rounded-lg bg-navy px-5 py-6 sm:max-w-[90%] sm:px-7 sm:py-8 lg:max-w-[60%] lg:grid-cols-2 lg:gap-2 lg:px-10 lg:py-9">
                <div>
                    <h2 class="font-heading text-2xl font-bold text-white sm:text-[29px]">Subscribe Us</h2>
                    <p class="mt-2 max-w-[380px] text-base leading-7 text-white/80 sm:text-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus.</p>
                </div>
                <div class="flex w-full max-w-[460px] flex-1 min-w-0 flex-col sm:flex-row">
                    <input type="email" placeholder="Email Address"
                           class="h-12 flex-1 rounded-none border-none bg-white px-4 text-sm text-gray-700 outline-none placeholder:text-gray-400 sm:h-[60px]">
                    <button type="button"
                            class="h-12 whitespace-nowrap rounded-none border-none bg-primary px-6 font-heading text-sm font-bold uppercase tracking-wide text-white transition-colors hover:bg-red-700 sm:h-[60px]">
                        Sign Up
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer Main Body -->
        <div class="-mt-[30px] pt-5 pb-16">
            <div class="mx-auto grid max-w-[1170px] grid-cols-1 md:grid-cols-3 gap-10 px-6 pt-5">

                <!-- Column 1: Logo + Description + Social -->
                <div>
                    <div class="mb-6">
                        <a href="{{ route('home') }}" class="inline-block">
                            <img src="{{ $siteSetting->logoUrl() }}" alt="{{ config('app.name') }}" class="h-[90px] w-auto max-w-full object-contain">
                        </a>
                    </div>

                    <p class="text-base leading-[1.9] text-white/70 sm:text-lg">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis us nostrud exercitation.</p>

                    <!-- Social Icons -->
                    <div class="mt-6 flex gap-[10px]">
                        <a href="{{ $siteSetting->facebook_url ?: '#' }}" class="flex h-12 w-12 items-center justify-center rounded-lg bg-primary transition-colors hover:bg-red-700 sm:h-[56px] sm:w-[56px]" aria-label="Facebook">
                            <svg width="30" height="30" fill="white" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="{{ $siteSetting->x_url ?: '#' }}" class="flex h-12 w-12 items-center justify-center rounded-lg bg-primary transition-colors hover:bg-red-700 sm:h-[56px] sm:w-[56px]" aria-label="X">
                            <svg width="30" height="30" fill="white" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.259 5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="{{ $siteSetting->youtube_url ?: '#' }}" class="flex h-12 w-12 items-center justify-center rounded-lg bg-primary transition-colors hover:bg-red-700 sm:h-[56px] sm:w-[56px]" aria-label="YouTube">
                            <svg width="30" height="30" fill="white" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                        </a>
                        <a href="{{ $siteSetting->instagram_url ?: '#' }}" class="flex h-12 w-12 items-center justify-center rounded-lg bg-primary transition-colors hover:bg-red-700 sm:h-[56px] sm:w-[56px]" aria-label="Instagram">
                            <svg width="30" height="30" fill="white" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h3 class="mb-5 border-b border-white/10 pb-4 font-heading text-2xl font-bold text-white sm:text-[30px]">Quick Links</h3>
                    <ul class="flex flex-col gap-[6px]">
                        <li>
                            <a href="{{ route('home') }}" class="flex items-center gap-[10px] text-[18px] font-medium text-white/80 no-underline transition-colors hover:text-primary sm:text-[22px]">
                                <svg class="h-8 w-8 shrink-0 fill-current text-primary sm:h-10 sm:w-10" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('services') }}" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                Services
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('training') }}" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                Training
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('courses.index') }}" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                Online courses
                            </a>
                        </li>
                        @auth
                            @unless (auth()->user()->is_admin)
                                <li>
                                    <a href="{{ route('student.dashboard') }}" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                        <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                        My learning
                                    </a>
                                </li>
                            @endunless
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                    <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                    Student login
                                </a>
                            </li>
                        @endauth
                        <li>
                            <a href="{{ route('blog') }}" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                Blogs
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact-us') }}" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Contact Us -->
                <div>
                    <h3 class="mb-5 border-b border-white/10 pb-4 font-heading text-2xl font-bold text-white sm:text-[30px]">Contact Us</h3>
                    <ul class="flex flex-col gap-[22px]">
                        <!-- Location -->
                        <li class="flex gap-[14px] items-start">
                            <svg class="w-8 h-8 shrink-0 mt-0.5 text-primary fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="mb-1 text-lg font-semibold text-white sm:text-xl">Location:</p>
                                <p class="text-base leading-7 text-white/70 sm:text-lg">{!! nl2br(e($siteSetting->location)) !!}</p>
                            </div>
                        </li>
                        <!-- Phone -->
                        <li class="flex gap-[14px] items-start">
                            <svg class="w-8 h-8 shrink-0 mt-0.5 text-primary fill-current" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            <div>
                                <p class="mb-1 text-lg font-semibold text-white sm:text-xl">Call Us :</p>
                                <a href="{{ $siteSetting->telHref() }}" class="text-base text-white/70 no-underline transition-colors hover:text-primary sm:text-lg">{{ $siteSetting->phone }}</a>
                            </div>
                        </li>
                        <!-- Email -->
                        <li class="flex gap-[14px] items-start">
                            <svg class="w-8 h-8 shrink-0 mt-0.5 text-primary fill-current" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <div>
                                <p class="mb-1 text-lg font-semibold text-white sm:text-xl">Email :</p>
                                <a href="mailto:{{ $siteSetting->email }}" class="text-base text-white/70 no-underline transition-colors hover:text-primary sm:text-lg">{{ $siteSetting->email }}</a>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- Copyright Bar -->
        <div class="border-t border-white/10 py-[18px] text-center bg-ink">
            <p class="text-white/60 text-[13px]">Copyright &copy; 2026 . Designed by Anzura Synatx.</p>
        </div>

    </div>

</footer>
