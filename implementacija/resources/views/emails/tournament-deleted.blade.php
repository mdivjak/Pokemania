<?php
/**
 * Markdown - mejl za brisanje turnira
 *
 * @author Anja Marković 0420/17
 *
 * @version 1.0
 */
?>

@component('mail::message')
# The "{{ $tournament->name }}" tournament has ended!
<br>
Dear <strong>{{ $user->name }}</strong>,
<br>
We would like to congratulate you on your success in the tournament!
{{ $message }}
<br>
<br>
Good luck in future tournaments,<br>
{{ config('app.name') }}
@endcomponent