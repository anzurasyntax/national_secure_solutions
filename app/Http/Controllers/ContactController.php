<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmittedMail;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('contact-us');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:80'],
            'message' => ['required', 'string', 'max:10000'],
        ]);

        $message = ContactMessage::query()->create($validated);

        $recipient = SiteSetting::current()->email;
        if ($recipient !== '') {
            Mail::to($recipient)->send(new ContactFormSubmittedMail($message));
        }

        return redirect()
            ->route('contact-us')
            ->with('status', 'Thank you — your message has been sent. We will get back to you soon.');
    }
}
