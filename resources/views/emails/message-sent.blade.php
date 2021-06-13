@component('mail::message')

#### New Message from
###### Name: {{ $name }}
###### Email: {{ $email }}

**Subject**: {{ $subject }} <br>

{{ $message }}

@component('mail::button', ['url' => $url])
Reply Message
@endcomponent

<br>

Regards,<br>
{{ $config->name }}

@endcomponent