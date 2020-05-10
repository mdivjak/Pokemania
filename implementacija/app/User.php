<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    public function addPokeCash ($amount) {
        $this->cntCash += $amount;
        $this->save();
    }
    
    protected $table = 'users';

    protected $primaryKey = 'idU';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'name', 'bAdmin', 'cntBalls' ,'cntCash', 'cntFruits', 'cntPokemons'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //-------------------------------ANJINO-----------------------------
    public function pokemons() 
    {
        return $this->belongsToMany('App\Pokemon', 'owns', 'user_id', 'pokemon_id');
    }

    public function tournaments() 
    {
        return $this->belongsToMany('App\User', 'participates', 'user_id', 'tournament_id');
    }

    public function cntWins($tournament_id) 
    {
        return DB::table('participates')->where([
            ['user_id', $this->idU],
            ['tournament_id', $tournament_id],
        ])->first()->cntWin;
    }

    public function isRegistered($tournament_id) 
    {
        $registered = DB::table('registered')->where([
            ['user_id', $this->idU],
            ['tournament_id', $tournament_id],
        ])->first();

        if ($registered != null) return true;
        return false;
    }

    public function participates($tournament_id) 
    {
        $participates = DB::table('participates')->where([
            ['user_id', $this->idU],
            ['tournament_id', $tournament_id],
        ])->first();

        if ($participates != null) return true;
        return false;
    }    

    public function hasEnoughPokemons(Tournament $tournament)
    {   
        $cnt = 0;
        foreach($this->pokemons as $pokemon) {
            $pokemon_level = DB::table('owns')->where([
                                ['user_id', $this->idU], 
                                ['pokemon_id', $pokemon->id],
                            ])->first()->level;

            if ($pokemon_level >= $tournament->minLevel && $pokemon_level <= $tournament->maxLevel)
                $cnt++;
            if ($cnt == 3) return true;
        }
        return false;
    }

    //---------------------------KRAJ ANJINOG-----------------------------------
}
