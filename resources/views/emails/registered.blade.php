@component('mail::message')

#### Hello, {{ $user->fullname }}
Thanks for signing up <span>&#x1F44B;</span>. Let's go traveling now!

@component('mail::button', ['url' => $home])
Go to Website
@endcomponent

If you did not sign up to {{ $config->name }}, please ignore this email or contact us at <a href="mailto:{{ $config->email }}">{{ $config->email }}</a>

---
Not sure why you received this email? Please [let us know](mailto:$config->email). 
<br>

Regards,<br>
{{ $config->name }}

@endcomponent