<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Tournament;


/**
 * AcceptRegistration - klasa koja predstavlja mejl koji se salje pri prihvatanju prijave za turnir
 *
 * @author Marko Divjak 0084/17
 *
 * @version 1.0
 */
class AcceptRegistration extends Mailable
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
        return $this->markdown('emails.accept-registration')->subject("You have been accepted to ".$this->tournament->name." tournament");
    }
}
