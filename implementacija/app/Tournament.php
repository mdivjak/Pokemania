<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    public function topParticipants()
    {
        return $this->belongsToMany('App\User', 'participates', 'tournament_id', 'user_id')
                    ->orderBy('cntWin', 'desc')
                    ->take(10);
    }
}
