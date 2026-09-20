New contact form message

Name: {{ $contactMessage->name }}
Email: {{ $contactMessage->email }}
@if ($contactMessage->phone)
Phone: {{ $contactMessage->phone }}
@endif

Message:
{{ $contactMessage->message }}
