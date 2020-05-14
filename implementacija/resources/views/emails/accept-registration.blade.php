@component('mail::message')
# You have been accepted to tournament {{ $tournament->name }}

{{ $user->name }}, your registration for {{ $tournament->name }} has been accepted.


@component('mail::button', ['url' => '{{ route("tournament.index") }}'])
Start Fighting
@endcomponent

We wish you all the best,<br>
{{ config('app.name') }}
@endcomponent
