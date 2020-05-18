<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Tournament;

/**
 * DeclineRegistration - klasa koja predstavlja mejl koji se salje pri odbijanju prijave za turnir
 *
 * @author Marko Divjak 0084/17
 *
 * @version 1.0
 */
class DeclineRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $tournament;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Tournament $tournament)
    {
        $this->user = $user;
        $this->tournament = $tournament;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.decline-registration')->subject("You have not been accepted to ".$this->tournament->name." tournament");
    }
}
