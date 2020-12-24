@component('mail::message')

    <p>You Have A new Message From {{$contact->name}}
        @if(strlen($title) > 0)
            About {{$title ??''}} In {{$address??''}}
        @endif
        To {{$contact->message}}</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
