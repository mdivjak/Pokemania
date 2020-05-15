<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;

class TournamentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $tournaments = Tournament::all();
        return view('tournaments.index', compact('tournaments'));
    }

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

    public function show(Tournament $tournament) 
    {
        if (DB::table('participates')->where([['user_id', Auth::id()], ['tournament_id', $tournament->id]])->first() == null && Auth::user()->bAdmin==0) 
            abort(404);
        Session::put("tournament", $tournament->id);
        return view('tournaments.show', compact('tournament'));
    }

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
