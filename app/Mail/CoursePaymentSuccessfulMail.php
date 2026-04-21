<?php

namespace App\Mail;

use App\Models\CourseOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CoursePaymentSuccessfulMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public CourseOrder $order)
    {
        $this->order->loadMissing('course');
    }

    public function envelope(): Envelope
    {
        $courseTitle = $this->order->course?->title ?? 'your course';

        return new Envelope(
            subject: 'Payment confirmed — '.$courseTitle,
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.course-payment-successful',
            text: 'emails.course-payment-successful-plain',
        );
    }
}
