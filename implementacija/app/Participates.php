<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Participates – model učešća na turniru
 *
 * @author ?
 *
 * @version 1.0
 */
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
