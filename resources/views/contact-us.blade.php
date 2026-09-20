@extends('layouts.app')

@section('content')
    @include('sections.header', ['pageTitle' => 'Contact Us'])

    <!-- Heading -->
    <div class="mb-10 pt-10 text-center sm:pt-12">
        <p class="text-red-600 font-bold text-sm tracking-widest uppercase mb-2">Drop Us A Line</p>
        <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl">Send Your Message</h2>
        <div class="w-10 h-1 bg-red-600 mx-auto rounded"></div>
    </div>

    <!-- Cards -->
    <div class="mx-auto mb-20 grid max-w-[92%] grid-cols-1 gap-6 sm:max-w-[88%] md:grid-cols-3 lg:mb-24 lg:max-w-[70%]">

        <!-- Location -->
        <div class="relative flex flex-col items-center rounded-2xl border border-green-300 px-6 pb-0 pt-8 text-center sm:px-8 sm:pt-10">
            <!-- Location Pin icon -->
            <svg class="w-10 h-10 text-red-600 mb-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-6-6.686-6-11a6 6 0 1112 0c0 4.314-6 11-6 11z"/>
                <circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.5" fill="none"/>
            </svg>
            <h3 class="mb-3 text-2xl font-bold text-gray-900 sm:text-3xl">Our Location</h3>
            <p class="mb-8 text-base leading-relaxed text-gray-500 sm:text-xl">
                {!! nl2br(e($siteSetting->location)) !!}
            </p>
            <!-- Button sits at the bottom edge -->
            <div class="translate-y-1/2 mt-auto">
                <a href="{{ $siteSetting->mapsTrackUrl() }}" target="_blank" rel="noopener noreferrer"
                   class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold tracking-widest uppercase px-8 py-3 rounded block transition">
                    TRACK
                </a>
            </div>
        </div>

        <!-- Phone -->
        <div class="relative flex flex-col items-center rounded-2xl border border-green-300 px-6 pb-0 pt-8 text-center sm:px-8 sm:pt-10">
            <!-- Headset / support icon -->
            <svg class="w-10 h-10 text-red-600 mb-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 18v-6a9 9 0 0118 0v6"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 18.5A1.5 1.5 0 0119.5 20H18a1.5 1.5 0 01-1.5-1.5v-2.5A1.5 1.5 0 0118 14.5h3v4zM3 18.5A1.5 1.5 0 004.5 20H6a1.5 1.5 0 001.5-1.5v-2.5A1.5 1.5 0 006 14.5H3v4z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 18v1a3 3 0 01-3 3h-2"/>
            </svg>
            <h3 class="mb-3 text-2xl font-bold text-gray-900 sm:text-3xl">Phone Number</h3>
            <p class="mb-8 text-base leading-relaxed text-gray-500 sm:text-xl">{{ $siteSetting->phone }}</p>
            <!-- Button sits at the bottom edge -->
            <div class="translate-y-1/2 mt-auto">
                <a href="{{ $siteSetting->telHref() }}"
                   class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold tracking-widest uppercase px-8 py-3 rounded block transition">
                    CALL US
                </a>
            </div>
        </div>

        <!-- Email -->
        <div class="relative flex flex-col items-center rounded-2xl border border-green-300 px-6 pb-0 pt-8 text-center sm:px-8 sm:pt-10">
            <!-- Envelope with X/lines icon -->
            <svg class="w-10 h-10 text-red-600 mb-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="4" width="20" height="16" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M2 6l10 7 10-7"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M2 18l6-5M22 18l-6-5"/>
            </svg>
            <h3 class="mb-3 text-2xl font-bold text-gray-900 sm:text-3xl">Email Address</h3>
            <p class="mb-8 break-all text-base leading-relaxed text-gray-500 sm:text-xl sm:break-normal">{{ $siteSetting->email }}</p>
            <!-- Button sits at the bottom edge -->
            <div class="translate-y-1/2 mt-auto">
                <a href="mailto:{{ $siteSetting->email }}"
                   class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold tracking-widest uppercase px-8 py-3 rounded block transition">
                    MAIL US
                </a>
            </div>
        </div>

    </div>
        <div class="mx-auto mb-24 max-w-[92%] rounded-xl bg-white px-4 py-8 shadow-2xl sm:max-w-[88%] sm:px-6 sm:py-10 lg:mb-40 lg:max-w-[70%] lg:py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0">

                <!-- Left: Contact Form -->
                <form method="POST" action="{{ route('contact-us.store') }}" class="flex flex-col justify-start gap-5 pr-0 md:pr-8">
                    @csrf

                    @if (session('status'))
                        <div class="rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Name -->
                    <div class="border border-gray-300 rounded px-4 py-3 @error('name') border-red-500 @enderror">
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Name"
                            required
                            class="w-full text-gray-500 text-base outline-none bg-transparent placeholder-gray-400"
                        />
                    </div>
                    @error('name')
                        <p class="-mt-3 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Email -->
                    <div class="border border-gray-300 rounded px-4 py-3 @error('email') border-red-500 @enderror">
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Email"
                            required
                            class="w-full text-gray-500 text-base outline-none bg-transparent placeholder-gray-400"
                        />
                    </div>
                    @error('email')
                        <p class="-mt-3 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Phone -->
                    <div class="border border-gray-300 rounded px-4 py-3 @error('phone') border-red-500 @enderror">
                        <input
                            type="tel"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="Phone"
                            class="w-full text-gray-500 text-base outline-none bg-transparent placeholder-gray-400"
                        />
                    </div>
                    @error('phone')
                        <p class="-mt-3 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Message -->
                    <div class="border border-gray-300 rounded px-4 py-3 @error('message') border-red-500 @enderror">
                        <textarea
                            name="message"
                            placeholder="Message"
                            rows="6"
                            required
                            class="w-full text-gray-500 text-base outline-none bg-transparent placeholder-gray-400 resize-y"
                        >{{ old('message') }}</textarea>
                    </div>
                    @error('message')
                        <p class="-mt-3 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Submit Button -->
                    <div>
                        <button
                            type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-bold tracking-widest uppercase text-sm px-8 py-4 rounded transition">
                            SEND A MESSAGE
                        </button>
                    </div>

                </form>

                <!-- Right: Google Map -->
                <div class="h-[320px] w-full overflow-hidden rounded sm:h-[420px] lg:h-[520px]">
                    <iframe
                        src="{{ $siteSetting->mapEmbedUrl() }}"
                        title="Map showing {{ $siteSetting->locationQuery() }}"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

            </div>
        </div>

@endsection
