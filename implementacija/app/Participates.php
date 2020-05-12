<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participates extends Model
{
    protected $table = 'participates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'tournament_id', 'cntWin'
    ];
}
