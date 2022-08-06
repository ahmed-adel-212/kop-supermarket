@component('mail::message')

Subject: {{$subject}}

Body: {{$body}}

# Contact:

Name: {{$name}}

Email: {{$email}}

First Number: {{$firstPhone}}

Second Number: {{$secondPhone}}

{{ config('app.name') }}
@endcomponent
