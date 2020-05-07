<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function show()
    {
        $user = User::find(1);
        // treba da bude Auth::user
        $pokemons = $user->pokemons;

        $collection = array();
        foreach($pokemons as $pokemon) {
            $collection[] = DB::table('owns')
                ->where([
                    ['user_id', $user->id],
                    ['pokemon_id', $pokemon->id],
                ])->get();
        }        

        return view("user.show", compact('user', 'collection'));        
    }

    public function feed()
    {
        // $userId = Auth::id();
        // $user = Auth::user();
        $userId = 1;
        $user = User::find(1);

        $user->cntFruits--;

        $user->save();

        //uvecavanje XP pokemona
        $data = DB::table('owns')->where([
                ['user_id', $userId],
                ['pokemon_id', request('pokemon')],
            ])->increment('xp', 10);

        // uvecavanje HP
        //prelazak na sledeci nivo? 

        return redirect()->back()->with('message', 'You have successfully fed your pokemon!');
    }

    public function release()
    {
        // $userId = Auth::id();
        // $user = Auth::user();
        $userId = 1;
        $user = User::find(1);

        $user->cntBalls++;
        $user->cntPokemons--;
        $user->save();

        DB::table('owns')->where([
                ['user_id', $userId],
                ['pokemon_id', request('pokemon')],
            ])->delete();

        return redirect()->back()->with('message', 'You have released your Pokemon!');
    }

    public function shop()
    {
        $user = User::find(1);
        // treba da bude Auth::user
        return view("user.shop", compact('user'));
    }

    public function buy()
    {
        $user = User::find(1);
        // treba da bude Auth::user

        if (request('buy') == 'pokeball' || request('buy') == 'fruit') {
            if ($user->cntCash < 50) 
                return redirect()->back()->with(['message_danger' => "You don't have enough pokecash for shopping!"]);
            else $user->cntCash -= 50;
        }
        else return redirect()->back();

        if (request('buy') == 'pokeball') {
            $user->cntBalls++;
        }
        else if (request('buy') == 'fruit') {
            $user->cntFruits++;
        }

        $user->save();

        return redirect()->back()->with('message', 'You have successfully completed your purchase!');
    }
}
