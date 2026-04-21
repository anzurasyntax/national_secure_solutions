@extends('layouts.app')

@section('content')
    @include('sections.header', ['pageTitle' => 'Training'])

<div class="max-w-[80%] mx-auto px-6 py-12">

    <!-- Training Intro -->
    <section class="mb-8">
        <h2 class="text-4xl font-bold text-black mb-3">Training</h2>
        <p class="text-4xl  font-bold text-black leading-relaxed">
            We offer the following Courses and we can list all the Courses
        </p>
    </section>

    <!-- SMS Welcome -->
    <section class="mb-8">
        <h2 class="text-4xl font-bold text-black mb-3">Welcome to the School of Management and Security (SMS) at Trans-World Security!</h2>
        <p class="text-lg text-black leading-relaxed">
            At SMS, we offer cutting-edge programs tailored to people's unique needs and equip future security leaders with the skills and knowledge to excel in today's dynamic security landscape. Our curriculum is designed to provide students with a comprehensive understanding of security management practices, strategic planning, risk assessment, fraud prevention, and crisis management. With a focus on practical skills and hands-on experience, SMS prepares graduates to tackle the challenges of modern security environments effectively. Join us at SMS to embark on a rewarding journey toward a successful career in security management.
        </p>
    </section>

    <!-- Courses List -->
    <section class="mb-8">
        <h2 class="text-4xl font-bold text-black mb-4">We also offer courses like:</h2>
        <ul class="list-disc list-inside space-y-2 text-lg text-black">
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
