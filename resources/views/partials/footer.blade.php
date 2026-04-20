
<footer class="font-body">

    <div class="relative bg-ink">

        <!-- Floating Subscribe Card -->
        <div class="flex justify-center relative z-10 -translate-y-[50px] px-6">
            <div class="bg-navy rounded-lg px-10 py-9 w-full max-w-[60%] grid grid-cols-2 gap-2 items-center justify-between">
                <div>
                    <h2 class="font-heading text-[29px] font-bold text-white">Subscribe Us</h2>
                    <p class="mt-2 text-white/80 leading-7 text-lg max-w-[380px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus.</p>
                </div>
                <div class="flex flex-1 min-w-[30%] max-w-[460px]">
                    <input type="email" placeholder="Email Address"
                           class="flex-1 h-[60px] bg-white border-none px-4 text-gray-700 text-sm outline-none rounded-none placeholder:text-gray-400">
                    <button type="button"
                            class="h-[60px] bg-primary text-white px-6 font-heading text-sm font-bold tracking-wide uppercase border-none cursor-pointer whitespace-nowrap rounded-none hover:bg-red-700 transition-colors">
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
                        <img src="{{ asset('img/logo.png') }}" alt="TransWorld Security Logo" class="h-[90px] w-auto object-contain">
                    </div>

                    <p class="text-white/70 leading-[1.9] text-lg">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis us nostrud exercitation.</p>

                    <!-- Social Icons -->
                    <div class="flex gap-[10px] mt-6">
                        <a href="{{ $siteSetting->facebook_url ?: '#' }}" class="w-[56px] h-[56px] bg-primary rounded-lg flex items-center justify-center hover:bg-red-700 transition-colors" aria-label="Facebook">
                            <svg width="30" height="30" fill="white" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="{{ $siteSetting->x_url ?: '#' }}" class="w-[56px] h-[56px] bg-primary rounded-lg flex items-center justify-center hover:bg-red-700 transition-colors" aria-label="X">
                            <svg width="30" height="30" fill="white" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.259 5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="{{ $siteSetting->youtube_url ?: '#' }}" class="w-[56px] h-[56px] bg-primary rounded-lg flex items-center justify-center hover:bg-red-700 transition-colors" aria-label="YouTube">
                            <svg width="30" height="30" fill="white" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                        </a>
                        <a href="{{ $siteSetting->instagram_url ?: '#' }}" class="w-[56px] h-[56px] bg-primary rounded-lg flex items-center justify-center hover:bg-red-700 transition-colors" aria-label="Instagram">
                            <svg width="30" height="30" fill="white" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h3 class="font-heading text-[30px] font-bold text-white pb-4 border-b border-white/10 mb-5">Quick Links</h3>
                    <ul class="flex flex-col gap-[6px]">
                        <li>
                            <a href="#" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                Services
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                Training
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                Blogs
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-[10px] text-white/80 no-underline text-[22px] font-medium hover:text-primary transition-colors">
                                <svg class="w-10 h-10 text-primary fill-current shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Contact Us -->
                <div>
                    <h3 class="font-heading text-[30px] font-bold text-white pb-4 border-b border-white/10 mb-5">Contact Us</h3>
                    <ul class="flex flex-col gap-[22px]">
                        <!-- Location -->
                        <li class="flex gap-[14px] items-start">
                            <svg class="w-8 h-8 shrink-0 mt-0.5 text-primary fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="text-white text-xl font-semibold mb-1">Location:</p>
                                <p class="text-white/70 text-lg leading-7">{!! nl2br(e($siteSetting->location)) !!}</p>
                            </div>
                        </li>
                        <!-- Phone -->
                        <li class="flex gap-[14px] items-start">
                            <svg class="w-8 h-8 shrink-0 mt-0.5 text-primary fill-current" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            <div>
                                <p class="text-white text-xl font-semibold mb-1">Call Us :</p>
                                <a href="{{ $siteSetting->telHref() }}" class="text-white/70 text-lg no-underline hover:text-primary transition-colors">{{ $siteSetting->phone }}</a>
                            </div>
                        </li>
                        <!-- Email -->
                        <li class="flex gap-[14px] items-start">
                            <svg class="w-8 h-8 shrink-0 mt-0.5 text-primary fill-current" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <div>
                                <p class="text-white text-xl font-semibold mb-1">Email :</p>
                                <a href="mailto:{{ $siteSetting->email }}" class="text-white/70 text-lg no-underline hover:text-primary transition-colors">{{ $siteSetting->email }}</a>
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
