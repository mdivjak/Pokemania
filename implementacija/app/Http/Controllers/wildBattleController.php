<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class wildBattleController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show() {
        Session::put("user", auth()->user()->idU);
        Session::put("load", "1");
        Session::put("loadAttack", "1");

        $trainersPokemonsFromTable=\DB::table('owns')->where('user_id', Session::get('user'))->get();

        $trainersPokemonsIDs=array();
        $trainersPokemonsLevels=array();
        foreach ($trainersPokemonsFromTable as $index => $value) {
            array_push($trainersPokemonsIDs, $value->id);
            array_push($trainersPokemonsLevels, $value->level);
        }

        $trainersPokemons=array();
        $trainersPokemonsLevelsForButtons=array();
        foreach ($trainersPokemonsIDs as $index => $value) {
            $pokeURL="http://pokeapi.co/api/v2/pokemon/"."$value";
            $data=file_get_contents($pokeURL.'/');
            $pokemonJSON=json_decode($data);
            array_push($trainersPokemons, $pokemonJSON->name);
            array_push($trainersPokemonsLevelsForButtons, \DB::table('owns')->where('user_id', Session::get('user'))->where('pokemon_id', $value)->first()->level);
        }
        
        $randNumber=rand(1,251);
        $pokeURL="http://pokeapi.co/api/v2/pokemon/"."$randNumber";
        $data=file_get_contents($pokeURL.'/');
        $pokemonJSON=json_decode($data);
        $imageURI="https://pokeres.bastionbot.org/images/pokemon/".$randNumber.".png";

        $randLevel=rand(min($trainersPokemonsLevels),max($trainersPokemonsLevels));
        // for testing
        // $randLevel=16;

        Session::put('wildPokemon',$pokemonJSON->name);
        Session::put('wildPokemonLevel',$randLevel);
        Session::put('wildPokemonHP', $randLevel*20);
        Session::put('wildPokemonMaxHP', $randLevel*20);

        return view('battles.wildBattle', [
            'pokemonName'=>$pokemonJSON->name,
            'pokemonLevel'=>$randLevel,
            'imageURI'=>$imageURI,
            'trainersPokemons'=>$trainersPokemons,
            'trainersPokemonsLevelsForButtons'=>$trainersPokemonsLevelsForButtons
        ]);
    }

    public function pick(Request $request) {
        $trainerPokemon=lcfirst($request->input('action'));
        
        $pokeURL="http://pokeapi.co/api/v2/pokemon/".$trainerPokemon;
        $data=file_get_contents($pokeURL.'/');
        $trainerPokemonJSON=json_decode($data);
        $trainerPokemonID=$trainerPokemonJSON->id;
        $trainerPokemonIMG="https://pokeres.bastionbot.org/images/pokemon/".$trainerPokemonID.".png";

        $trainerPokemonLevel=\DB::table('owns')->where('user_id', Session::get('user'))->where('pokemon_id', $trainerPokemonID)->first()->level;
        $trainerPokemonXP=\DB::table('owns')->where('user_id', Session::get('user'))->where('pokemon_id', $trainerPokemonID)->first()->xp;
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

        $pokeballNumber=\DB::table('users')->where('idU', Session::get('user'))->first()->cntBalls;
        return view('battles.wildBattlePicked', [
            'text'=> 'Pokeballs: '.$pokeballNumber
        ]);
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

    public function gain() {

        if (Session::get("loadAttack")=="1") Session::put("loadAttack", "0");

        $gainedXP=Session::get('wildPokemonLevel'); 
        $gainedCash=$gainedXP*10;
        $requiredXP=Session::get('trainerPokemonLevel')*5;
        $currentXP=\DB::table('owns')->where('user_id', Session::get('user'))->where('pokemon_id', Session::get('trainerPokemonID'))->first()->xp;

        //if max level
        if (Session::get('trainerPokemonLevel')==50) $gainedXP=0;
        if (Session::get('trainerPokemonLevel')==50) $currentXP=0;

        $newXP=$currentXP+$gainedXP;
        $newLevel=false;
        while ($newXP>=$requiredXP) {
            $newLevel=true;
            $newXP=$newXP-$requiredXP;
            \DB::table('owns')->where('user_id', Session::get('user'))->where('pokemon_id', Session::get('trainerPokemonID'))->increment('level', 1);
            Session::put('trainerPokemonLevel', Session::get('trainerPokemonLevel')+1);
            $requiredXP=Session::get('trainerPokemonLevel')*5;

            //if max level
            if (Session::get('trainerPokemonLevel')==50) break;

        }
        \DB::table('owns')->where('user_id', Session::get('user'))->where('pokemon_id', Session::get('trainerPokemonID'))->update(['xp'=>$newXP]);
        \DB::table('users')->where('idU', Session::get('user'))->increment('cntCash', $gainedCash);

        $message='You won and gained '.$gainedCash.'ß, '.ucfirst(Session::get('trainerPokemon')).' gained '.$gainedXP.'XP';
        if ($newLevel) {
            $message=$message.' and grew to level '.Session::get('trainerPokemonLevel');
        }
        return $message.'!';
    }

    public function lose() {

        if (Session::get("loadAttack")=="1") Session::put("loadAttack", "0");

        $lostCash=Session::get('wildPokemonLevel')*5;
        $currentCash=\DB::table('users')->where('idU', Session::get('user'))->first()->cntCash;
        $newCash=$currentCash-$lostCash;
        if ($newCash<0) {
            $lostCash=$currentCash;
            $newCash=0;
        }
        \DB::table('users')->where('idU', Session::get('user'))->update(['cntCash'=>$newCash]);
        return 'You lost and dropped '.$lostCash.'ß!';
    }

    public function attack() {
        if (Session::get("loadAttack")=="0") {
            return view('battles.welcome');
        }

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
                    $pokeButtonEnable=' disabled';
                    $pokeLinkEnable='pointer-events: none';
                    if (Session::get('wildPokemonMaxHP')/$wildPokemonHP>=2) {
                        $pokeButtonEnable='';
                        $pokeLinkEnable='';
                    }
                    $pokeballNumber=\DB::table('users')->where('idU', Session::get('user'))->first()->cntBalls;
                    if ($pokeballNumber==0) {
                        $pokeButtonEnable=' disabled';
                        $pokeLinkEnable='pointer-events: none';
                    }
                    return view('battles.wildBattleAttacked', [
                        'text'=> 'Pokeballs: '.$pokeballNumber,
                        'fightButtonEnable'=>'',
                        'pokeButtonEnable'=>$pokeButtonEnable,
                        'fightLinkEnable'=>'',
                        'pokeLinkEnable'=>$pokeLinkEnable,
                        'backButtonEnable'=>' disabled',
                        'backLinkEnable'=>'pointer-events: none'
                    ]);
                }
                else {

                    $message=$this->lose();

                    return view('battles.wildBattleAttacked', [
                        'text'=>$message,
                        'fightButtonEnable'=>' disabled',
                        'pokeButtonEnable'=>' disabled',
                        'fightLinkEnable'=>'pointer-events: none',
                        'pokeLinkEnable'=>'pointer-events: none',
                        'backButtonEnable'=>'',
                        'backLinkEnable'=>''
                    ]); 
                }
            } else {

                $message=$this->gain();

                return view('battles.wildBattleAttacked', [
                    'text'=>$message,
                    'fightButtonEnable'=>' disabled',
                    'pokeButtonEnable'=>' disabled',
                    'fightLinkEnable'=>'pointer-events: none',
                    'pokeLinkEnable'=>'pointer-events: none',
                    'backButtonEnable'=>'',
                    'backLinkEnable'=>''
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
                    $pokeLinkEnable='pointer-events: none';
                    if (Session::get('wildPokemonMaxHP')/$wildPokemonHP>=2) {
                        $pokeButtonEnable='';
                        $pokeLinkEnable='';
                    }
                    $pokeballNumber=\DB::table('users')->where('idU', Session::get('user'))->first()->cntBalls;
                    if ($pokeballNumber==0) {
                        $pokeButtonEnable=' disabled';
                        $pokeLinkEnable='pointer-events: none';
                    }
                    return view('battles.wildBattleAttacked', [
                        'text'=>'Pokeballs: '.$pokeballNumber,
                        'fightButtonEnable'=>'',
                        'pokeButtonEnable'=>$pokeButtonEnable,
                        'fightLinkEnable'=>'',
                        'pokeLinkEnable'=>$pokeLinkEnable,
                        'backButtonEnable'=>' disabled',
                        'backLinkEnable'=>'pointer-events: none'
                    ]);
                }
                else {

                    $message=$this->gain();

                    return view('battles.wildBattleAttacked', [
                        'text'=>$message,
                        'fightButtonEnable'=>' disabled',
                        'pokeButtonEnable'=>' disabled',
                        'fightLinkEnable'=>'pointer-events: none',
                        'pokeLinkEnable'=>'pointer-events: none',
                        'backButtonEnable'=>'',
                        'backLinkEnable'=>''
                    ]); 
                }
            } else {

                $message=$this->lose();

                return view('battles.wildBattleAttacked', [
                    'text'=>$message,
                    'fightButtonEnable'=>' disabled',
                    'pokeButtonEnable'=>' disabled',
                    'fightLinkEnable'=>'pointer-events: none',
                    'pokeLinkEnable'=>'pointer-events: none',
                    'backButtonEnable'=>'',
                    'backLinkEnable'=>''
                ]);
            }
        }
    }

    public function catch() {
        if (Session::get("load")=="0") {
            return view('battles.welcome');
        }
        if (Session::get("load")=="1") Session::put("load", "0");

        \DB::table('users')->where('idU', Session::get('user'))->decrement('cntBalls', 1);
        $wildPokemonMaxHP=Session::get('wildPokemonMaxHP');
        $wildPokemonHP=Session::get('wildPokemonHP');

        $percent=$wildPokemonHP/$wildPokemonMaxHP;

        if ($percent>0.25) {
            $chance=rand(1,2);
            if ($chance==1) {
                //fail
                return view('battles.wildBattleAttacked', [
                    'text'=>ucfirst(Session::get('wildPokemon')).' got away!',
                    'fightButtonEnable'=>' disabled',
                    'pokeButtonEnable'=>' disabled',
                    'fightLinkEnable'=>'pointer-events: none',
                    'pokeLinkEnable'=>'pointer-events: none',
                    'backButtonEnable'=>'',
                    'backLinkEnable'=>''
                ]);
            }
            else {
                //catch
                \DB::table('owns')->insert(
                    ['user_id' => Session::get('user'), 'pokemon_id' => Session::get('wildPokemonID'),
                    'xp' => 0, 'level' => Session::get('wildPokemonLevel')]
                );
                \DB::table('users')->where('idU', Session::get('user'))->increment('cntPokemons', 1);
                return view('battles.wildBattleAttacked', [
                    'text'=>'You caught '.ucfirst(Session::get('wildPokemon')).'!',
                    'fightButtonEnable'=>' disabled',
                    'pokeButtonEnable'=>' disabled',
                    'fightLinkEnable'=>'pointer-events: none',
                    'pokeLinkEnable'=>'pointer-events: none',
                    'backButtonEnable'=>'',
                    'backLinkEnable'=>''
                ]);
            }
        }
        else {
            $chance=rand(1,4);
            if ($chance==1) {
                //fail
                return view('battles.wildBattleAttacked', [
                    'text'=>ucfirst(Session::get('wildPokemon')).' got away!',
                    'fightButtonEnable'=>' disabled',
                    'pokeButtonEnable'=>' disabled',
                    'fightLinkEnable'=>'pointer-events: none',
                    'pokeLinkEnable'=>'pointer-events: none',
                    'backButtonEnable'=>'',
                    'backLinkEnable'=>''
                ]);
            }
            else {
                //catch
                \DB::table('owns')->insert(
                    ['user_id' => Session::get('user'), 'pokemon_id' => Session::get('wildPokemonID'),
                    'xp' => 0, 'level' => Session::get('wildPokemonLevel')]
                );
                \DB::table('users')->where('idU', Session::get('user'))->increment('cntPokemons', 1);
                return view('battles.wildBattleAttacked', [
                    'text'=>'You caught '.ucfirst(Session::get('wildPokemon')).'!',
                    'fightButtonEnable'=>' disabled',
                    'pokeButtonEnable'=>' disabled',
                    'fightLinkEnable'=>'pointer-events: none',
                    'pokeLinkEnable'=>'pointer-events: none',
                    'backButtonEnable'=>'',
                    'backLinkEnable'=>''
                ]);
            }
        }
    }
}