<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\AdminController;

class Tournament extends Model
{
    protected $table = 'tournaments';

    public function topParticipants()
    {
        return $this->belongsToMany('App\User', 'participates', 'tournament_id', 'user_id')
                    ->orderBy('cntWin', 'desc')
                    ->take(10);
    }

    public function allParticipants()
    {
        return $this->belongsToMany('App\User', 'participates', 'tournament_id', 'user_id')
                    ->orderBy('cntWin', 'desc');
    }

    public function registeredUsers()
    {
        return $this->belongsToMany('App\User', 'registered', 'tournament_id', 'user_id');
    }

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
