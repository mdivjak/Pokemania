<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\AdminController;

/**
 * Tournament – model turnira
 *
 * @author Anja Marković 0420/17
 *
 * @version 1.0
 */
class Tournament extends Model
{
    protected $table = 'tournaments';

    /**
     * Funkcija koja vraća prvih 10 najboljih učesnika na turniru
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    public function topParticipants()
    {
        return $this->belongsToMany('App\User', 'participates', 'tournament_id', 'user_id')
                    ->orderBy('cntWin', 'desc')
                    ->take(10);
    }

    /**
     * Funkcija koja vraća sve učesnike turnira
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    public function allParticipants()
    {
        return $this->belongsToMany('App\User', 'participates', 'tournament_id', 'user_id')
                    ->orderBy('cntWin', 'desc');
    }

    /**
     * Funkcija koja vraća sve korisnike, registrovane na turnir
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    public function registeredUsers()
    {
        return $this->belongsToMany('App\User', 'registered', 'tournament_id', 'user_id');
    }

    /**
     * Funkcija koja proverava da li se zadati korisnik nalazi u top 10 učesnika turnira
     *
     * @return bool
     *
     */
    public function ifTop10(User $user)
    {
        $top10 = $this->topParticipants;
        foreach($top10 as $u) {
            if ($user->idU == $u->idU)
                return true;
        }
        return false;
    }

    public function registrations() {
        return $this->hasMany('App\Registered');
    }
}