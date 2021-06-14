@component('mail::message')

**New Message from** <br>
Name: {{ $name }} <br>
Email: {{ $email }} <br>

**Subject: {{ $subjects }}** <br>

{{ $message }}

@component('mail::button', ['url' => $url])
Reply Message
@endcomponent

<br>

Regards,<br>
{{ $config->name }}

@endcomponent