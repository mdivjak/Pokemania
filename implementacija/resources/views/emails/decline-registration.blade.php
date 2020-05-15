@component('mail::message')
# Your registration has been declined for the "{{ $tournament->name }}" tournament

Dear {{ $user->name }},

Unfortunately your registration for the tournament "{{ $tournament->name }}" has been declined.

<b>The registration fee of {{ $tournament->entryFee }} ₽ has been added back to your account.</b>

Good luck in future tournaments,<br>
{{ config('app.name') }}
@endcomponent
