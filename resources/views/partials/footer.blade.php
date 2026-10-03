<footer class="relative overflow-hidden bg-[#080B12] pt-20 sm:pt-28">
    {{-- Decorative subtle glow --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 left-1/2 h-80 w-full -translate-x-1/2 bg-[radial-gradient(ellipse_at_top,rgba(255,255,255,0.03),transparent_70%)]"></div>
    </div>
    
    {{-- Top accent line --}}
    <div class="absolute top-0 left-0 h-1 w-full bg-gradient-to-r from-transparent via-primary/50 to-transparent"></div>

    <div class="relative z-10 mx-auto max-w-[1440px] px-5 sm:px-8 xl:px-12">
        
        <div class="grid grid-cols-1 gap-12 pb-16 md:grid-cols-2 lg:grid-cols-12 lg:gap-8">
            
            {{-- Brand & About (wider column) --}}
            <div class="flex flex-col lg:col-span-4">
                <a href="{{ route('home') }}" class="mb-8 block" aria-label="Home">
                    <img src="{{ $siteSetting->logoUrl() }}" alt="{{ config('app.name') }}" class="h-14 w-auto max-w-[200px] object-contain brightness-0 invert">
                </a>
                <p class="mb-8 font-sans text-sm leading-relaxed text-white/60 pr-8">
                    Delivering professional protection, advanced security systems, and dependable solutions designed strictly around your safety. We are committed to securing what matters most.
                </p>
                
                {{-- Social Icons --}}
                <div class="flex gap-4">
                    <a href="{{ $siteSetting->facebook_url ?: '#' }}" aria-label="Facebook" class="grid h-10 w-10 place-items-center rounded-xl border border-white/10 bg-white/5 text-white/70 transition-all hover:-translate-y-1 hover:border-primary/50 hover:bg-primary/20 hover:text-white">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="{{ $siteSetting->x_url ?: '#' }}" aria-label="X" class="grid h-10 w-10 place-items-center rounded-xl border border-white/10 bg-white/5 text-white/70 transition-all hover:-translate-y-1 hover:border-primary/50 hover:bg-primary/20 hover:text-white">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.259 5.63z"/></svg>
                    </a>
                    <a href="{{ $siteSetting->youtube_url ?: '#' }}" aria-label="YouTube" class="grid h-10 w-10 place-items-center rounded-xl border border-white/10 bg-white/5 text-white/70 transition-all hover:-translate-y-1 hover:border-primary/50 hover:bg-primary/20 hover:text-white">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088C19.537 3.616 12 3.616 12 3.616s-7.537 0-9.407.501A3.007 3.007 0 00.505 6.205 31.247 31.247 0 000 12a31.247 31.247 0 00.505 5.795 3.007 3.007 0 002.088 2.088C4.463 20.384 12 20.384 12 20.384s7.537 0 9.407-.501a3.007 3.007 0 002.088-2.088A31.247 31.247 0 0024 12a31.247 31.247 0 00-.505-5.795zM9.6 15.6V8.4l6.3 3.6-6.3 3.6z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="lg:col-span-2 lg:ml-auto">
                <h3 class="mb-6 font-heading text-xs font-bold uppercase tracking-[0.2em] text-white">Company</h3>
                <ul class="flex flex-col gap-4">
                    <li><a href="{{ route('home') }}" class="font-sans text-sm text-white/60 transition hover:text-primary">Home</a></li>
                    <li><a href="{{ route('about') }}" class="font-sans text-sm text-white/60 transition hover:text-primary">About Us</a></li>
                    <li><a href="{{ route('services') }}" class="font-sans text-sm text-white/60 transition hover:text-primary">Services</a></li>
                    <li><a href="{{ route('training') }}" class="font-sans text-sm text-white/60 transition hover:text-primary">Training</a></li>
                    <li><a href="{{ route('blog') }}" class="font-sans text-sm text-white/60 transition hover:text-primary">News & Blog</a></li>
                    <li><a href="{{ route('contact-us') }}" class="font-sans text-sm text-white/60 transition hover:text-primary">Contact Us</a></li>
                </ul>
            </div>

            {{-- Resources --}}
            <div class="lg:col-span-2 lg:ml-auto">
                <h3 class="mb-6 font-heading text-xs font-bold uppercase tracking-[0.2em] text-white">Resources</h3>
                <ul class="flex flex-col gap-4">
                    <li><a href="{{ route('courses.index') }}" class="font-sans text-sm text-white/60 transition hover:text-primary">Online Courses</a></li>
                    @auth
                        @unless (auth()->user()->is_admin)
                            <li><a href="{{ route('student.dashboard') }}" class="font-sans text-sm text-white/60 transition hover:text-primary">My Learning</a></li>
                        @endunless
                    @else
                        <li><a href="{{ route('login') }}" class="font-sans text-sm text-white/60 transition hover:text-primary">Student Login</a></li>
                    @endauth
                    <li><a href="#" class="font-sans text-sm text-white/60 transition hover:text-primary">Privacy Policy</a></li>
                    <li><a href="#" class="font-sans text-sm text-white/60 transition hover:text-primary">Terms of Service</a></li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div class="lg:col-span-4 lg:ml-auto w-full">
                <h3 class="mb-6 font-heading text-xs font-bold uppercase tracking-[0.2em] text-white">Newsletter</h3>
                <p class="mb-6 font-sans text-sm leading-relaxed text-white/60">Subscribe for the latest security updates, expert tips, and exclusive offers.</p>
                
                <form class="flex w-full flex-col gap-3">
                    <input type="email" placeholder="Email Address" required
                           class="w-full rounded-xl border border-white/10 bg-white/5 px-5 py-4 font-sans text-sm text-white placeholder-white/40 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <button type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-primary px-5 py-4 font-heading text-xs font-bold uppercase tracking-widest text-white transition hover:bg-red-700">
                        Subscribe <span aria-hidden="true">→</span>
                    </button>
                </form>
            </div>
            
        </div>
        
        {{-- Contact Info Strip --}}
        <div class="grid grid-cols-1 gap-6 border-t border-white/10 py-10 md:grid-cols-3">
            
            <div class="group flex items-start gap-4">
                <div class="mt-1 grid h-10 w-10 shrink-0 place-items-center rounded-lg border border-white/5 bg-white/5 text-primary transition-colors group-hover:bg-primary group-hover:text-white">
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                </div>
                <div>
                    <p class="font-heading text-[10px] font-bold uppercase tracking-[0.2em] text-white/40">Location</p>
                    <p class="mt-1 font-sans text-sm leading-relaxed text-white/80">{!! nl2br(e($siteSetting->location)) !!}</p>
                </div>
            </div>
            
            <div class="group flex items-start gap-4">
                <div class="mt-1 grid h-10 w-10 shrink-0 place-items-center rounded-lg border border-white/5 bg-white/5 text-primary transition-colors group-hover:bg-primary group-hover:text-white">
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                </div>
                <div>
                    <p class="font-heading text-[10px] font-bold uppercase tracking-[0.2em] text-white/40">Phone</p>
                    <a href="{{ $siteSetting->telHref() }}" class="mt-1 block font-sans text-sm text-white/80 transition hover:text-primary">{{ $siteSetting->phone }}</a>
                </div>
            </div>
            
            <div class="group flex items-start gap-4">
                <div class="mt-1 grid h-10 w-10 shrink-0 place-items-center rounded-lg border border-white/5 bg-white/5 text-primary transition-colors group-hover:bg-primary group-hover:text-white">
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                </div>
                <div>
                    <p class="font-heading text-[10px] font-bold uppercase tracking-[0.2em] text-white/40">Email</p>
                    <a href="mailto:{{ $siteSetting->email }}" class="mt-1 block font-sans text-sm text-white/80 transition hover:text-primary">{{ $siteSetting->email }}</a>
                </div>
            </div>
            
        </div>

    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-white/5 bg-[#050810]/50 py-6 backdrop-blur-md">
        <div class="mx-auto flex max-w-[1440px] flex-col items-center justify-between gap-4 px-5 sm:px-8 md:flex-row xl:px-12">
            <p class="font-sans text-xs text-white/40">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
            <p class="font-sans text-xs text-white/40">
                Designed by Anzura Syntax
            </p>
        </div>
    </div>
</footer>
