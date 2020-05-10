<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class trainerBattleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show() {

        Session::put("user", auth()->user()->idU);
        Session::put("tournament", "1");

        //get all participants
        $allOpponents=\DB::table('participates')->where('tournament_id', Session::get('tournament'))->where('user_id', '!=', Session::get('user'))->get();

        //remove participants that don't have enough pokemons with required level
        $minLevel=\DB::table('tournaments')->where('id', Session::get('tournament'))->first()->minLevel;
        $maxLevel=\DB::table('tournaments')->where('id', Session::get('tournament'))->first()->maxLevel;
        $allowedPokemons=array();
        $allowedOpponents=array();
        foreach($allOpponents as $index => $opponent) {
            $allowedPokemons[$allOpponents[$index]->user_id]=\DB::table('owns')->where('user_id', $allOpponents[$index]->user_id)->where('level', '>=', $minLevel)->where('level', '<=', $maxLevel)->get();
            if (count($allowedPokemons[$allOpponents[$index]->user_id])>=3) array_push($allowedOpponents, $allOpponents[$index]->user_id);
        }
        
        //randomly pick an opponent
        $randomPick=rand(0, count($allowedOpponents)-1);
        $opponent=$allowedOpponents[$randomPick];
        Session::put('opponentNick', \DB::table('users')->where('user_id', $opponent)->first()->name);
        Session::put('trainerNick', \DB::table('users')->where('user_id', Session::get('user'))->first()->name);
        Session::put('opponent', $opponent);

        //randomly pick their 3 pokemons
        $allowedPokemonsIDs=array();
        foreach($allowedPokemons[$opponent] as $index => $pokemon) {
            array_push($allowedPokemonsIDs, $allowedPokemons[$opponent][$index]->pokemon_id);
        }
        $opponentPokemonsKeys=array_rand($allowedPokemonsIDs, 3);
        shuffle($opponentPokemonsKeys);
        $opponentPokemons=array();
        array_push($opponentPokemons, $allowedPokemonsIDs[$opponentPokemonsKeys[0]]);
        array_push($opponentPokemons, $allowedPokemonsIDs[$opponentPokemonsKeys[1]]);
        array_push($opponentPokemons, $allowedPokemonsIDs[$opponentPokemonsKeys[2]]);

        //get their levels
        $opponentPokemonsLevels=array();
        array_push($opponentPokemonsLevels, \DB::table('owns')->where('user_id', $opponent)->where('pokemon_id', $opponentPokemons[0])->first()->level);
        array_push($opponentPokemonsLevels, \DB::table('owns')->where('user_id', $opponent)->where('pokemon_id', $opponentPokemons[1])->first()->level);
        array_push($opponentPokemonsLevels, \DB::table('owns')->where('user_id', $opponent)->where('pokemon_id', $opponentPokemons[2])->first()->level);

        //get user's allowed pokemons and their levels
        $trainersPokemonsFromTable=\DB::table('owns')->where('user_id', Session::get('user'))->where('level', '>=', $minLevel)->where('level', '<=', $maxLevel)->get();
        $trainersPokemonsIDs=array();
        $trainersPokemonsLevelsForButtons=array();
        foreach ($trainersPokemonsFromTable as $index => $pokemon) {
            array_push($trainersPokemonsIDs, $pokemon->pokemon_id);
            array_push($trainersPokemonsLevelsForButtons, $pokemon->level);
        }
        $trainersPokemons=array();
        foreach ($trainersPokemonsIDs as $index => $value) {
            $pokeURL="http://pokeapi.co/api/v2/pokemon/"."$value";
            $data=file_get_contents($pokeURL.'/');
            $pokemonJSON=json_decode($data);
            array_push($trainersPokemons, $pokemonJSON->name);
        }

        Session::put('trainerPokemons', $trainersPokemons);
        Session::put('trainerPokemonsIDs', $trainersPokemonsIDs);
        Session::put('trainerPokemonsLevels', $trainersPokemonsLevelsForButtons);
        Session::put('opponentPickedPokemonsIDs', $opponentPokemons);
        Session::put('opponentPickedPokemonsLevels', $opponentPokemonsLevels);

        return view('battles.trainerBattle',[
            'text'=>'Choose 3 Pokemon!',
            'opponentNick'=>\DB::table('users')->where('user_id', $opponent)->first()->name,
            'trainerPokemonsIDs'=>$trainersPokemonsIDs,
            'trainerPokemons'=>$trainersPokemons,
            'trainerPokemonsLevelsForButtons'=>$trainersPokemonsLevelsForButtons
        ]);
    }

    public function setParametersForNextBattle($battleNumber) {

        $trainerPokemonID=Session::get('trainerPickedPokemonsIDs')[$battleNumber];
        $opponentPokemonID=Session::get('opponentPickedPokemonsIDs')[$battleNumber];

        $pokeURL="http://pokeapi.co/api/v2/pokemon/".$trainerPokemonID;
        $data=file_get_contents($pokeURL.'/');
        $trainerPokemonJSON=json_decode($data);
        $trainerPokemon=$trainerPokemonJSON->name;
        $trainerPokemonIMG="https://pokeres.bastionbot.org/images/pokemon/".$trainerPokemonID.".png";

        $pokeURL="http://pokeapi.co/api/v2/pokemon/".$opponentPokemonID;
        $data=file_get_contents($pokeURL.'/');
        $opponentPokemonJSON=json_decode($data);
        $opponentPokemon=$opponentPokemonJSON->name;
        $opponentPokemonIMG="https://pokeres.bastionbot.org/images/pokemon/".$opponentPokemonID.".png";

        $trainerPokemonLevel=\DB::table('owns')->where('user_id', Session::get('user'))->where('pokemon_id', $trainerPokemonID)->first()->level;
        $trainerPokemonXP=\DB::table('owns')->where('user_id', Session::get('user'))->where('pokemon_id', $trainerPokemonID)->first()->xp;
        
        $opponentPokemonLevel=\DB::table('owns')->where('user_id', Session::get('opponent'))->where('pokemon_id', $opponentPokemonID)->first()->level;

        Session::put('trainerPokemon',$trainerPokemon);
        Session::put('trainerPokemonLevel',$trainerPokemonLevel);
        Session::put('trainerPokemonMaxHP', $trainerPokemonLevel*20);
        Session::put('trainerPokemonHP', $trainerPokemonLevel*20);
        Session::put('trainerPokemonXP', $trainerPokemonXP);
        Session::put('trainerPokemonIMG',$trainerPokemonIMG);
        Session::put('trainerPokemonID', $trainerPokemonID);
        Session::put('opponentPokemonID', $opponentPokemonID);
        Session::put('opponentPokemonIMG', $opponentPokemonIMG);
        Session::put('opponentPokemon', $opponentPokemon);
        Session::put('opponentPokemonLevel', $opponentPokemonLevel);
        Session::put('opponentPokemonHP', $opponentPokemonLevel*20);
        Session::put('opponentPokemonMaxHP', $opponentPokemonLevel*20);

        $trainerPokemonTypes=$trainerPokemonJSON->types;

        $trainerPokemonType1=json_encode($trainerPokemonTypes[0]);
        $trainerPokemonType1=json_decode($trainerPokemonType1)->type->name;

        $trainerPokemonType2="";
        if (array_key_exists(1, $trainerPokemonTypes)) {
            $trainerPokemonType2=json_encode($trainerPokemonTypes[1]);
            $trainerPokemonType2=json_decode($trainerPokemonType2)->type->name;
        }

        Session::put('trainerPokemonType1',$trainerPokemonType1);
        Session::put('trainerPokemonType2',$trainerPokemonType2);


        $opponentPokemonTypes=$opponentPokemonJSON->types;

        $opponentPokemonType1=json_encode($opponentPokemonTypes[0]);
        $opponentPokemonType1=json_decode($opponentPokemonType1)->type->name;

        $opponentPokemonType2="";
        if (array_key_exists(1, $opponentPokemonTypes)) {
            $opponentPokemonType2=json_encode($opponentPokemonTypes[1]);
            $opponentPokemonType2=json_decode($opponentPokemonType2)->type->name;
        }

        Session::put('opponentPokemonType1',$opponentPokemonType1);
        Session::put('opponentPokemonType2',$opponentPokemonType2);

    } 

    public function pick(Request $request) {

        $picked=$request->input('picked');
        shuffle($picked);

        //check if user picked exactly 3 pokemon
        if (count($picked)!=3) {
            return view('battles.trainerBattle',[
                'text'=>'You need to choose exactly 3 Pokemon!',
                'opponentNick'=>Session::get('opponentNick'),
                'trainerPokemonsIDs'=>Session::get('trainerPokemonsIDs'),
                'trainerPokemons'=>Session::get('trainerPokemons'),
                'trainerPokemonsLevelsForButtons'=>Session::get('trainerPokemonsLevels')
            ]);
        }
        
        //store users picked pokemon and their levels
        $trainerPickedPokemonsLevels=array();
        foreach($picked as $index => $pokemon) {
            array_push($trainerPickedPokemonsLevels, \DB::table('owns')->where('user_id', Session::get('user'))->where('pokemon_id', $pokemon)->first()->level);
        }
        Session::put('trainerPickedPokemonsIDs', $picked);
        Session::put('trainerPickedPokemonsLevels', $trainerPickedPokemonsLevels);

        //set types, HP, IMGs..
        Session::put('battleNumber', '0');
        $this->setParametersForNextBattle(Session::get('battleNumber'));

        //win counter
        Session::put('winCnt', '0');

        return view('battles.trainerBattlePicked',[
            'text'=> Session::get('trainerNick').' VS '.Session::get('opponentNick').' : Battle ' .(Session::get('battleNumber')+1).'!'
        ]);
    }
}
