@component('mail::message')
# The "{{ $tournament->name }}" tournament has ended!

Dear {{ $user->name }},

We would like to congratulate you on your success in the tournament!
{{ $message }}

Good luck in future tournaments,<br>
{{ config('app.name') }}
@endcomponent