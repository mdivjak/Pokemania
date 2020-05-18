<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

/**
 * User – model ulogovanog korisnika 
 *
 * @author Anja Marković 0420/17
 *
 * @version 1.0
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public function addPokeCash () {
        $this->cntCash += env('QUIZ_PRIZE');
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
        'email', 'password', 'name', 'bAdmin', 'cntBalls' ,'cntCash', 'cntFruits', 'cntPokemons', 'avatar'
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

    /**
     * Funkcija koja vraća sve pokemone nekog korisnika
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    public function pokemons() 
    {
        return $this->belongsToMany('App\Pokemon', 'owns', 'user_id', 'pokemon_id');
    }

    /**
     * Funkcija koja vraća sve turnire na kojima učestvuje neki korisnik
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    public function tournaments() 
    {
        return $this->belongsToMany('App\User', 'participates', 'user_id', 'tournament_id');
    }

    /**
     * Funkcija koja vraća sve turnire na kojima učestvuje neki korisnik
     *
     * @param  int  $tournament_id
     *
     * @return int
     *
     */
    public function cntWins($tournament_id) 
    {
        return DB::table('participates')->where([
            ['user_id', $this->idU],
            ['tournament_id', $tournament_id],
        ])->first()->cntWin;
    }

    /**
     * Funkcija koja proverava da li je korisnik registrovan na zadati turnir
     *
     * @param  int  $tournament_id
     *
     * @return bool
     *
     */
    public function isRegistered($tournament_id) 
    {
        $registered = DB::table('registered')->where([
            ['user_id', $this->idU],
            ['tournament_id', $tournament_id],
        ])->first();

        if ($registered != null) return true;
        return false;
    }

    /**
     * Funkcija koja proverava da li korisnik učestvuje na zadatom turniru
     *
     * @param  int  $tournament_id
     *
     * @return bool
     *
     */
    public function participates($tournament_id) 
    {
        $participates = DB::table('participates')->where([
            ['user_id', $this->idU],
            ['tournament_id', $tournament_id],
        ])->first();

        if ($participates != null) return true;
        return false;
    }    

    /**
     * Funkcija koja proverava da li korisnik ima dovoljno pokemona koji ispunjavaju uslov zadatog turnira
     *
     * @param  App\Tournament  $tournament
     *
     * @return bool
     *
     */
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

    /**
     * Funkcija koja vraća route key User modela
     *
     * @return string
     *
     */
    public function getRouteKeyName()
    {
        return 'name';
    }
}
