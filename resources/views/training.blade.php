@extends('layouts.app')

@section('content')
    @include('sections.header', ['pageTitle' => 'Training'])

<div class="mx-auto max-w-[92%] px-4 py-10 sm:max-w-[88%] sm:px-6 sm:py-12 lg:max-w-[80%]">

    <!-- Training Intro -->
    <section class="mb-8">
        <h2 class="mb-3 text-3xl font-bold text-black sm:text-4xl">Training</h2>
        <p class="text-2xl font-bold leading-relaxed text-black sm:text-4xl">
            We offer the following Courses and we can list all the Courses
        </p>
    </section>

    <!-- SMS Welcome -->
    <section class="mb-8">
        <h2 class="mb-3 text-2xl font-bold text-black sm:text-4xl">Welcome to the School of Management and Security (SMS) at National Secure Solutions!</h2>
        <p class="text-base leading-relaxed text-black sm:text-lg">
            At SMS, we offer cutting-edge programs tailored to people's unique needs and equip future security leaders with the skills and knowledge to excel in today's dynamic security landscape. Our curriculum is designed to provide students with a comprehensive understanding of security management practices, strategic planning, risk assessment, fraud prevention, and crisis management. With a focus on practical skills and hands-on experience, SMS prepares graduates to tackle the challenges of modern security environments effectively. Join us at SMS to embark on a rewarding journey toward a successful career in security management.
        </p>
    </section>

    <!-- Courses List -->
    <section class="mb-8">
        <div class="mb-6 rounded-xl border border-gray-200 bg-gray-50 px-6 py-5">
            <p class="text-base font-semibold text-black sm:text-lg">Structured online programmes with modules, checkout, and certificates are available on our <a href="{{ route('courses.index') }}" class="text-primary underline hover:no-underline">online courses page</a>.</p>
        </div>
        <h2 class="mb-4 text-3xl font-bold text-black sm:text-4xl">We also offer courses like:</h2>
        <ul class="list-disc list-inside space-y-2 text-base text-black sm:text-lg">
            <li>-Financial Security 101</li>
            <li>-Financial Security 202</li>
            <li>-Financial Management &amp; Security</li>
            <li>-Fraud Prevention Course</li>
            <li>-Security Survival Course</li>
            <li>-Crime and Loss Prevention Course</li>
            <li>-Stress Management</li>
            <li>-Time Management</li>
            <li>-Substance Abuse Violence</li>
            <li>-Basic Intelligence Operations</li>
            <li>-Intelligence Analysis</li>
            <li>-Intelligence Management</li>
            <li>-Intelligence Management 202</li>
            <li>-Corporate Security Management</li>
            <li>-Strategic Management</li>
            <li>-Disaster Management</li>
            <li>-Crisis Management</li>
            <li>-Advanced Guard Management</li>
            <li>-Corporate Assets Protection</li>
            <li>-Strategies for Combating Kidnap</li>
            <li>-Security Coordination and Management</li>
            <li>-Basic Protection</li>
            <li>-Basic Security Officer</li>
            <li>-Advanced Security Officer</li>
            <li>-Security Supervisor</li>
            <li>-Front Desk</li>
            <li>-Campus Security</li>
            <li>-Physical Security</li>
            <li>-Executive Protection</li>
            <li>-Defensive and Security Driving</li>
        </ul>
    </section>

</div>
@endsection
