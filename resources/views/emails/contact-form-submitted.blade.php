<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New contact message</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.5;">
    <h2 style="margin-bottom: 0.5rem;">New contact form message</h2>
    <p><strong>Name:</strong> {{ $contactMessage->name }}</p>
    <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
    @if ($contactMessage->phone)
        <p><strong>Phone:</strong> {{ $contactMessage->phone }}</p>
    @endif
    <p><strong>Message:</strong></p>
    <p style="white-space: pre-wrap;">{{ $contactMessage->message }}</p>
</body>
</html>
