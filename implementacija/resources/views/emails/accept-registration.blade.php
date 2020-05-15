@component('mail::message')
# You have been accepted to the "{{ $tournament->name }}" tournament

Dear {{ $user->name }},

Your registration for the "{{ $tournament->name }}" tournament has been accepted.


@component('mail::button', ['url' => route('tournament.index') ])
Start Fighting
@endcomponent

Good luck fighting in this tournament,<br>
{{ config('app.name') }}
@endcomponent
