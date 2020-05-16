<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Tournament;

class TournamentDeleted extends Mailable
{
    use Queueable; //, SerializesModels;

    public $user;
    public $tournament;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Tournament $tournament, $message)
    {
        $this->user = $user;
        $this->tournament = $tournament;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.tournament-deleted')->subject("The ".$this->tournament->name." tournament has ended!");
    }
}
