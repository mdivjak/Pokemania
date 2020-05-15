@component('mail::message')

# You have been accepted to the "{{ $tournament->name }}" tournament
<br>
Dear <strong>{{ $user->name }}</strong>,
<br>

Your registration for the "{{ $tournament->name }}" tournament has been accepted.


@component('mail::button', ['url' => route('tournament.index') ])
Start Fighting
@endcomponent

<br>

Good luck fighting in this tournament,<br>
{{ config('app.name') }}

@endcomponent