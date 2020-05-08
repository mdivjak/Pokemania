<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class wildBattleController {

    public function show() {

        Session::put("user", "1");
        Session::put("load", "1");

        $trainersPokemonsFromTable=\DB::table('owns')->where('idU', Session::get('user'))->get();

        $trainersPokemonsIDs=array();
        $trainersPokemonsLevels=array();
        foreach ($trainersPokemonsFromTable as $index => $value) {
            array_push($trainersPokemonsIDs, $value->idP);
            array_push($trainersPokemonsLevels, $value->level);
        }

        $trainersPokemons=array();
        foreach ($trainersPokemonsIDs as $index => $value) {
            $pokeURL="http://pokeapi.co/api/v2/pokemon/"."$value";
            $data=file_get_contents($pokeURL.'/');
            $pokemonJSON=json_decode($data);
            array_push($trainersPokemons, $pokemonJSON->name);
        }

        $randNumber=rand(1,807);
        $pokeURL="http://pokeapi.co/api/v2/pokemon/"."$randNumber";
        $data=file_get_contents($pokeURL.'/');
        $pokemonJSON=json_decode($data);
        $imageURI="https://pokeres.bastionbot.org/images/pokemon/".$randNumber.".png";

        $randLevel=rand(min($trainersPokemonsLevels),max($trainersPokemonsLevels));

        Session::put('wildPokemon',$pokemonJSON->name);
        Session::put('wildPokemonLevel',$randLevel);
        Session::put('wildPokemonHP', $randLevel*20);
        Session::put('wildPokemonMaxHP', $randLevel*20);

        return view('wildBattle', [
            'pokemonName'=>$pokemonJSON->name,
            'pokemonLevel'=>$randLevel,
            'imageURI'=>$imageURI,
            'trainersPokemons'=>$trainersPokemons
        ]);
    }

    public function pick(Request $request) {
        $trainerPokemon=lcfirst($request->input('action'));
        
        $pokeURL="http://pokeapi.co/api/v2/pokemon/".$trainerPokemon;
        $data=file_get_contents($pokeURL.'/');
        $trainerPokemonJSON=json_decode($data);
        $trainerPokemonID=$trainerPokemonJSON->id;
        $trainerPokemonIMG="https://pokeres.bastionbot.org/images/pokemon/".$trainerPokemonID.".png";

        $trainerPokemonLevel=\DB::table('owns')->where('idU', Session::get('user'))->where('idP', $trainerPokemonID)->first()->level;
        $trainerPokemonXP=\DB::table('owns')->where('idU', Session::get('user'))->where('idP', $trainerPokemonID)->first()->xp;
        $wildPokemon=Session::get('wildPokemon');
        $wildPokemonLevel=Session::get('wildPokemonLevel');

        Session::put('trainerPokemon',$trainerPokemon);
        Session::put('trainerPokemonLevel',$trainerPokemonLevel);
        Session::put('trainerPokemonMaxHP', $trainerPokemonLevel*20);
        Session::put('trainerPokemonHP', $trainerPokemonLevel*20);
        Session::put('trainerPokemonXP', $trainerPokemonXP);
        Session::put('trainerPokemonIMG',$trainerPokemonIMG);
        Session::put('trainerPokemonID',$trainerPokemonID);

        $pokeURL="http://pokeapi.co/api/v2/pokemon/".$wildPokemon;
        $data=file_get_contents($pokeURL.'/');
        $wildPokemonJSON=json_decode($data);
        $wildPokemonID=$wildPokemonJSON->id;
        $wildPokemonIMG="https://pokeres.bastionbot.org/images/pokemon/".$wildPokemonID.".png";
        Session::put('wildPokemonID',$wildPokemonID);
        Session::put('wildPokemonIMG',$wildPokemonIMG);


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


        $wildPokemonTypes=$wildPokemonJSON->types;

        $wildPokemonType1=json_encode($wildPokemonTypes[0]);
        $wildPokemonType1=json_decode($wildPokemonType1)->type->name;

        $wildPokemonType2="";
        if (array_key_exists(1, $wildPokemonTypes)) {
            $wildPokemonType2=json_encode($wildPokemonTypes[1]);
            $wildPokemonType2=json_decode($wildPokemonType2)->type->name;
        }

        Session::put('wildPokemonType1',$wildPokemonType1);
        Session::put('wildPokemonType2',$wildPokemonType2);

        return view('wildBattlePicked');
    }

    public function getDoubleFrom($type) {
        if ($type=='') return array();

        $data=file_get_contents("https://pokeapi.co/api/v2/type/".$type.'/');
        $info=json_decode($data);
        $damage_relations=$info->damage_relations;
        $double_damage_from=$damage_relations->double_damage_from;

        $double_damage_from_names=array();
        foreach ($double_damage_from as $index => $value) {
            array_push($double_damage_from_names, $value->name);
        }

        return $double_damage_from_names;
    }

    public function getDoubleTo($type) {
        if ($type=='') return array("none");

        $data=file_get_contents("https://pokeapi.co/api/v2/type/".$type.'/');
        $info=json_decode($data);
        $damage_relations=$info->damage_relations;
        $double_damage_to=$damage_relations->double_damage_to;

        $double_damage_to_names=array("none");
        foreach ($double_damage_to as $index => $value) {
            array_push($double_damage_to_names, $value->name);
        }

        return $double_damage_to_names;
    }

    public function attack() {
        $trainerPokemonLevel=Session::get('trainerPokemonLevel');
        $wildPokemonLevel=Session::get('wildPokemonLevel');
        $trainerDamage=rand($trainerPokemonLevel*1.5-7, $trainerPokemonLevel*1.5+7);
        if ($trainerDamage<=0) $trainerDamage=6;
        $wildDamage=rand($wildPokemonLevel*1.5-7, $wildPokemonLevel*1.5+7);
        if ($wildDamage<=0) $wildDamage=3;

        $trainerPokemonType1=Session::get('trainerPokemonType1');
        $trainerPokemonType2=Session::get('trainerPokemonType2');
        $wildPokemonType1=Session::get('wildPokemonType1');
        $wildPokemonType2=Session::get('wildPokemonType2');

        $double_from1=$this->getDoubleFrom($trainerPokemonType1);
        $double_from2=$this->getDoubleFrom($trainerPokemonType2);
        $double_to1=$this->getDoubleTo($trainerPokemonType1);
        $double_to2=$this->getDoubleTo($trainerPokemonType2);

        if(in_array($wildPokemonType1, $double_from1)) { $trainerDamage/=2; $wildDamage*=2; }
        if(in_array($wildPokemonType1, $double_from2)) { $trainerDamage/=2; $wildDamage*=2; }
        if(in_array($wildPokemonType2, $double_from1)) { $trainerDamage/=2; $wildDamage*=2; }
        if(in_array($wildPokemonType2, $double_from2)) { $trainerDamage/=2; $wildDamage*=2; }

        if(in_array($wildPokemonType1, $double_to1)) { $trainerDamage*=2; $wildDamage/=2; }
        if(in_array($wildPokemonType1, $double_to2)) { $trainerDamage*=2; $wildDamage/=2; }
        if(in_array($wildPokemonType2, $double_to1)) { $trainerDamage*=2; $wildDamage/=2; }
        if(in_array($wildPokemonType2, $double_to2)) { $trainerDamage*=2; $wildDamage/=2; }
        
        $turn=rand(1,2);
        if ($turn==1) {
            $wildPokemonHP=Session::get('wildPokemonHP');
            $wildPokemonHP-=$trainerDamage;
            if ($wildPokemonHP<=0) $wildPokemonHP=0;
            Session::put('wildPokemonHP', $wildPokemonHP);
            if ($wildPokemonHP>0) {
                $trainerPokemonHP=Session::get('trainerPokemonHP');
                $trainerPokemonHP-=$wildDamage;
                if ($trainerPokemonHP<=0) $trainerPokemonHP=0;
                Session::put('trainerPokemonHP', $trainerPokemonHP);
                if ($trainerPokemonHP>0) {
                    $pokeButtonEnable='disabled';
                    if (Session::get('wildPokemonMaxHP')/$wildPokemonHP>=2) $pokeButtonEnable='';
                    return view('wildBattleAttacked', [
                        'text'=>'Battle!',
                        'fightButtonEnable'=>'',
                        'pokeButtonEnable'=>$pokeButtonEnable
                    ]);
                }
                else {
                    return view('wildBattleAttacked', [
                        'text'=>'You lost!',
                        'fightButtonEnable'=>' disabled',
                        'pokeButtonEnable'=>' disabled'
                    ]); 
                }
            } else {
                return view('wildBattleAttacked', [
                    'text'=>'You won!',
                    'fightButtonEnable'=>' disabled',
                    'pokeButtonEnable'=>' disabled'
                ]);
            }
        }
        else {
            $trainerPokemonHP=Session::get('trainerPokemonHP');
            $trainerPokemonHP-=$wildDamage;
            if ($trainerPokemonHP<=0) $trainerPokemonHP=0;
            Session::put('trainerPokemonHP', $trainerPokemonHP);
            if ($trainerPokemonHP>0) {
                $wildPokemonHP=Session::get('wildPokemonHP');
                $wildPokemonHP-=$trainerDamage;
                if ($wildPokemonHP<=0) $wildPokemonHP=0;
                Session::put('wildPokemonHP', $wildPokemonHP);
                if ($wildPokemonHP>0) {
                    $pokeButtonEnable='disabled';
                    if (Session::get('wildPokemonMaxHP')/$wildPokemonHP>=2) $pokeButtonEnable='';
                    return view('wildBattleAttacked', [
                        'text'=>'Battle!',
                        'fightButtonEnable'=>'',
                        'pokeButtonEnable'=>$pokeButtonEnable
                    ]);
                }
                else {
                    return view('wildBattleAttacked', [
                        'text'=>'You won!',
                        'fightButtonEnable'=>' disabled',
                        'pokeButtonEnable'=>' disabled'
                    ]); 
                }
            } else {
                return view('wildBattleAttacked', [
                    'text'=>'You lost!',
                    'fightButtonEnable'=>' disabled',
                    'pokeButtonEnable'=>' disabled'
                ]);
            }
        }
    }

    public function catch() {
        if (Session::get("load")=="0") {
            return view('welcome');
        }
        if (Session::get("load")=="1") Session::put("load", "0");

        $wildPokemonMaxHP=Session::get('wildPokemonMaxHP');
        $wildPokemonHP=Session::get('wildPokemonHP');

        $percent=$wildPokemonHP/$wildPokemonMaxHP;

        if ($percent>0.25) {
            $chance=rand(1,2);
            if ($chance==1) {
                //fail
                return view('wildBattleAttacked', [
                    'text'=>ucfirst(Session::get('wildPokemon')).' got away!',
                    'fightButtonEnable'=>' disabled',
                    'pokeButtonEnable'=>' disabled'
                ]);
            }
            else {
                //catch
                \DB::table('owns')->insert(
                    ['idU' => Session::get('user'), 'idP' => Session::get('wildPokemonID'),
                    'xp' => 0, 'level' => Session::get('wildPokemonLevel')]
                );
                return view('wildBattleAttacked', [
                    'text'=>'You caught '.ucfirst(Session::get('wildPokemon')).'!',
                    'fightButtonEnable'=>' disabled',
                    'pokeButtonEnable'=>' disabled'
                ]);
            }
        }
        else {
            $chance=rand(1,4);
            if ($chance==1) {
                //fail
                return view('wildBattleAttacked', [
                    'text'=>ucfirst(Session::get('wildPokemon')).' got away!',
                    'fightButtonEnable'=>' disabled',
                    'pokeButtonEnable'=>' disabled'
                ]);
            }
            else {
                //catch
                \DB::table('owns')->insert(
                    ['idU' => Session::get('user'), 'idP' => Session::get('wildPokemonID'),
                    'xp' => 0, 'level' => Session::get('wildPokemonLevel')]
                );
                return view('wildBattleAttacked', [
                    'text'=>'You caught '.ucfirst(Session::get('wildPokemon')).'!',
                    'fightButtonEnable'=>' disabled',
                    'pokeButtonEnable'=>' disabled'
                ]);
            }
        }
    }
}