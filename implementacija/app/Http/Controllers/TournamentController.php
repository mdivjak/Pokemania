<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;

/**
 * TournamentController – klasa za implementaciju metoda vezanih za turnire 
 *
 * @author Anja Marković 0420/17
 *
 * @version 1.0
 */
class TournamentController extends Controller
{
    /**
     * Kreira novi TournamentController objekat
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Prikazivanje stranice svih aktivnih turnira 
     * 
     * @return \Illuminate\View\View
     */
    public function index() 
    {
        $tournaments = Tournament::all();
        return view('tournaments.index', compact('tournaments'));
    }

    /**
     * Funkcija za registrovanje korisnika na turnir 
     * 
     * @param  App\Tournament  $tournament
     * 
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Tournament $tournament)  
    {   
        $user = Auth::user();

        if ($user->cntCash < $tournament->entryFee) {
            return redirect()->back()->with('message', "You don't have enough money for registration!");
        }
        if (!$user->hasEnoughPokemons($tournament)) {
            return redirect()->back()->with('message', "You don't have enough pokemons for this tournament!");
        }

        DB::table('registered')->insert(
            ['user_id' => $user->idU, 'tournament_id' => $tournament->id]
        );

        $user->cntCash -= $tournament->entryFee;
        $user->save();
        
        return redirect()->back()->with('message_success', 'You have successfully registered for this tournament');
    }

    /**
     * Prikazivanje stranice zadatog turnira
     * 
     * @param  App\Tournament  $tournament
     * 
     * @return \Illuminate\Routing\Redirector
     */
    public function show(Tournament $tournament) 
    {
        if (Auth::user()->bAdmin==0 && DB::table('participates')->where([['user_id', Auth::id()], ['tournament_id', $tournament->id]])->first() == null) 
            abort(404);
        Session::put("tournament", $tournament->id);
        return view('tournaments.show', compact('tournament'));
    }

    /**
     * Funkcija za napuštanje turnira od strane korisnika 
     * 
     * @param  App\Tournament  $tournament
     * 
     * @return \Illuminate\Routing\Redirector
     */
    public function delete(Tournament $tournament) 
    {
        $user = Auth::user();

        $participated = DB::table('participates')->where([
            ['user_id', $user->idU],
            ['tournament_id', $tournament->id],
        ])->delete();

        return redirect()->route('tournament.index')->with('message_success', 'You left the tournament!');
    }
}
