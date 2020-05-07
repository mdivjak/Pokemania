<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class wildBattleController {

    public function show() {

        $randNumber=rand(1,807);
        $pokeURL="http://pokeapi.co/api/v2/pokemon/"."$randNumber";
        $data=file_get_contents($pokeURL.'/');
        $pokemonJSON=json_decode($data);
        $imageURI="https://pokeres.bastionbot.org/images/pokemon/".$randNumber.".png";

        $trainersPokemons=array("sceptile", "totodile", "suicune", "lugia", "gengar", "mew", "salamence", "houndoom");

        $randLevel=rand(20,30);

        session(['wildPokemon'=>$pokemonJSON->name]);
        session(['wildPokemonLevel'=>$randLevel]);

        return view('wildBattle', [
            'pokemonName'=>$pokemonJSON->name,
            'pokemonLevel'=>$randLevel,
            'imageURI'=>$imageURI,
            'trainersPokemons'=>$trainersPokemons
        ]);
    }

    public function pick(Request $request) {
        $trainerPokemon=lcfirst($request->input('action'));
        $trainerPokemonLevel=25;
        $wildPokemon=$request->session()->pull('wildPokemon');
        $wildPokemonLevel=$request->session()->pull('wildPokemonLevel');

        session(['trainerPokemon'=>$trainerPokemon]);
        session(['trainerPokemonLevel'=>$trainerPokemonLevel]);

        $pokeURL="http://pokeapi.co/api/v2/pokemon/".$trainerPokemon;
        $data=file_get_contents($pokeURL.'/');
        $trainerPokemonJSON=json_decode($data);
        $trainerPokemonID=$trainerPokemonJSON->id;
        $trainerPokemonIMG="https://pokeres.bastionbot.org/images/pokemon/".$trainerPokemonID.".png";

        $pokeURL="http://pokeapi.co/api/v2/pokemon/".$wildPokemon;
        $data=file_get_contents($pokeURL.'/');
        $wildPokemonJSON=json_decode($data);
        $wildPokemonID=$wildPokemonJSON->id;
        $wildPokemonIMG="https://pokeres.bastionbot.org/images/pokemon/".$wildPokemonID.".png";


        $trainerPokemonTypes=$trainerPokemonJSON->types;

        $trainerPokemonType1=json_encode($trainerPokemonTypes[0]);
        $trainerPokemonType1=json_decode($trainerPokemonType1)->type->name;

        $trainerPokemonType2="";
        if (array_key_exists(1, $trainerPokemonTypes)) {
            $trainerPokemonType2=json_encode($trainerPokemonTypes[1]);
            $trainerPokemonType2=json_decode($trainerPokemonType2)->type->name;
        }

        session(['trainerPokemonType1'=>$trainerPokemonType1]);
        session(['trainerPokemonType2'=>$trainerPokemonType2]);


        $wildPokemonTypes=$wildPokemonJSON->types;

        $wildPokemonType1=json_encode($wildPokemonTypes[0]);
        $wildPokemonType1=json_decode($wildPokemonType1)->type->name;

        $wildPokemonType2="";
        if (array_key_exists(1, $wildPokemonTypes)) {
            $wildPokemonType2=json_encode($wildPokemonTypes[1]);
            $wildPokemonType2=json_decode($wildPokemonType2)->type->name;
        }

        session(['wildPokemonType1'=>$wildPokemonType1]);
        session(['wildPokemonType2'=>$wildPokemonType2]);

        return view('wildBattlePicked', [
            'trainerPokemonName'=>$trainerPokemon,
            'wildPokemonName'=>$wildPokemon,
            'trainerPokemonIMG'=>$trainerPokemonIMG,
            'wildPokemonIMG'=>$wildPokemonIMG,
            'trainerPokemonType1'=>$trainerPokemonType1,
            'trainerPokemonType2'=>$trainerPokemonType2,
            'wildPokemonType1'=>$wildPokemonType1,
            'wildPokemonType2'=>$wildPokemonType2,
            'trainerPokemonLevel'=>$trainerPokemonLevel,
            'wildPokemonLevel'=>$wildPokemonLevel,
            'request'=>$request
        ]);
    }
}