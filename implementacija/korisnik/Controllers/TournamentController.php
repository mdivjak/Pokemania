<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TournamentController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index() 
    {
        $tournaments = Tournament::all();
        return view('tournaments.index', compact('tournaments'));
    }

    public function store(Tournament $tournament)  
    {   
        $user = User::find(1);
        //auth user       

        if ($user->cntCash < $tournament->entryFee) {
            return redirect()->back()->with('message', "You don't have enough money for registration!");
        }
        if ($user->cntPokemons < 3) {
            return redirect()->back()->with('message', "You don't have enough pokemons for registration!");
        }
        // provera za min i max level

        DB::table('registered')->insert(
            ['user_id' => $user->id, 'tournament_id' => $tournament->id]
        );

        $user->cntCash -= $tournament->entryFee;
        $user->save();
        
        return redirect()->back()->with('message_success', 'You have successfully registered for this tournament');
    }

    public function show(Tournament $tournament) 
    {
        return view('tournaments.show', compact('tournament'));
    }

    public function delete(Tournament $tournament) 
    {
        $user = User::find(1);
        //auth user  

        $participated = DB::table('participates')->where([
            ['user_id', $user->id],
            ['tournament_id', $tournament->id],
        ])->delete();

        return redirect()->route('tournament.index')->with('message_success', 'You left the tournament!');
    }
}
