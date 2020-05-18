<?php
/**
 * Sadrzaj mejla za obavestavanje o odbijanju prijave za turnir
 *
 * @author Marko Divjak 0084/2017, Natalija Mitić 0085/2017
 *
 * @version 1.0
 */
?>
@component('mail::message')
# Your registration has been declined for the "{{ $tournament->name }}" tournament
<br>
Dear <strong>{{ $user->name }}</strong>, <br>
Unfortunately your registration for the tournament "{{ $tournament->name }}" has been declined.
<br> <br>
<b>The registration fee of {{ $tournament->entryFee }} ₽ has been added back to your account.</b>
<br> <br>
Good luck in future tournaments,<br>
{{ config('app.name') }}
@endcomponent
