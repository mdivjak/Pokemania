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
        Session::put("loadAttack", "1");
        Session::put("loadPick", "1");

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
 
        if (count($allowedOpponents)==0) {
            return redirect()->back()->with('message', 'There are currently no opponents in the tournament!');
        }

        //randomly pick an opponent
        $randomPick=rand(0, count($allowedOpponents)-1);
        $opponent=$allowedOpponents[$randomPick];
        Session::put('opponentNick', \DB::table('users')->where('idU', $opponent)->first()->name);
        Session::put('trainerNick', \DB::table('users')->where('idU', Session::get('user'))->first()->name);
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
            'opponentNick'=>\DB::table('users')->where('idU', $opponent)->first()->name,
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
        
        if (Session::get("loadPick")=="0") {
            return $this->show();
        }

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
        else {
            if (Session::get("loadPick")=="1") Session::put("loadPick", "0");
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
        Session::put('trainerWins', '0');
        Session::put('opponentWins', '0');

        $message=$this->initialMessage();
        return view('battles.trainerBattlePicked',[
            'text'=> $message
        ]);
    }

    public function lose() {
        if (Session::get("loadAttack")=="1") Session::put("loadAttack", "0");

        $lostCash=\DB::table('tournaments')->where('id', Session::get('tournament'))->first()->entryFee/2;
        $currentCash=\DB::table('users')->where('idU', Session::get('user'))->first()->cntCash;
        $newCash=$currentCash-$lostCash;
        if ($newCash<0) {
            $lostCash=$currentCash;
            $newCash=0;
        }
        \DB::table('users')->where('idU', Session::get('user'))->update(['cntCash'=>$newCash]);
        return ' -> You lost and dropped '.$lostCash.'₽!';
    }

    public function win() {
        if (Session::get("loadAttack")=="1") Session::put("loadAttack", "0");

        $gainedCash=\DB::table('tournaments')->where('id', Session::get('tournament'))->first()->entryFee/2;
        \DB::table('users')->where('idU', Session::get('user'))->increment('cntCash', $gainedCash);
        \DB::table('participates')->where('user_id', Session::get('user'))->increment('cntWin', 1);

        return ' -> You won and gained '.$gainedCash.'₽!';
    }


    public function endBattle() {
        if (Session::get('trainerWins') > Session::get('opponentWins')) return $this->win();
        else return $this->lose();
    }


    public function gain($battleNumber) {

        $trainerPokemonID=Session::get('trainerPickedPokemonsIDs')[$battleNumber];
        $opponentPokemonID=Session::get('opponentPickedPokemonsIDs')[$battleNumber];
        
        $trainerPokemonLevel=\DB::table('owns')->where('user_id', Session::get('user'))->where('pokemon_id', $trainerPokemonID)->first()->level;
        $opponentPokemonLevel=\DB::table('owns')->where('user_id', Session::get('opponent'))->where('pokemon_id', $opponentPokemonID)->first()->level;

        $gainedXP=$opponentPokemonLevel;
        $requiredXP=$trainerPokemonLevel*5;
        $currentXP=\DB::table('owns')->where('user_id', Session::get('user'))->where('pokemon_id', $trainerPokemonID)->first()->xp;

        //if max level
        if ($trainerPokemonLevel==50) $gainedXP=0;
        if ($trainerPokemonLevel==50) $currentXP=0;

        $newXP=$currentXP+$gainedXP;
        $newLevel=false;
        while ($newXP>=$requiredXP) {
            $newLevel=true;
            $newXP=$newXP-$requiredXP;
            \DB::table('owns')->where('user_id', Session::get('user'))->where('pokemon_id', $trainerPokemonID)->increment('level', 1);
            $trainerPokemonLevel+=1;
            $requiredXP=$trainerPokemonLevel*5;

            //if max level
            if ($trainerPokemonLevel==50) break;

        }
        \DB::table('owns')->where('user_id', Session::get('user'))->where('pokemon_id', $trainerPokemonID)->update(['xp'=>$newXP]);

        $pokeURL="http://pokeapi.co/api/v2/pokemon/".$trainerPokemonID;
        $data=file_get_contents($pokeURL.'/');
        $trainerPokemonJSON=json_decode($data);
        $trainerPokemon=$trainerPokemonJSON->name;
        $message=', '.ucfirst($trainerPokemon).' gained '.$gainedXP.'XP';
        if ($newLevel) {
            $message=$message.' and grew to level '.Session::get('trainerPokemonLevel');
        }
        return $message.'!';
    }

    public function initialMessage() {
        return Session::get('trainerNick').' '.Session::get('trainerWins').' : '.Session::get('opponentWins').' '.Session::get('opponentNick');
    }

    public function attack() {
        if (Session::get("loadAttack")=="0") {
            return $this->show();
        }

        $trainerPokemonLevel=Session::get('trainerPokemonLevel');
        $opponentPokemonLevel=Session::get('opponentPokemonLevel');
        $trainerDamage=rand($trainerPokemonLevel*1.5-7, $trainerPokemonLevel*1.5+7);
        if ($trainerDamage<=0) $trainerDamage=6;
        $opponentDamage=rand($opponentPokemonLevel*1.5-7, $opponentPokemonLevel*1.5+7);
        if ($opponentDamage<=0) $opponentDamage=3;

        $trainerPokemonType1=Session::get('trainerPokemonType1');
        $trainerPokemonType2=Session::get('trainerPokemonType2');
        $opponentPokemonType1=Session::get('opponentPokemonType1');
        $opponentPokemonType2=Session::get('opponentPokemonType2');

        $neededController=app('App\Http\Controllers\wildBattleController');

        $double_from1=$neededController->getDoubleFrom($trainerPokemonType1);
        $double_from2=$neededController->getDoubleFrom($trainerPokemonType2);
        $double_to1=$neededController->getDoubleTo($trainerPokemonType1);
        $double_to2=$neededController->getDoubleTo($trainerPokemonType2);

        if(in_array($opponentPokemonType1, $double_from1)) { $trainerDamage/=2; $opponentDamage*=2; }
        if(in_array($opponentPokemonType1, $double_from2)) { $trainerDamage/=2; $opponentDamage*=2; }
        if(in_array($opponentPokemonType2, $double_from1)) { $trainerDamage/=2; $opponentDamage*=2; }
        if(in_array($opponentPokemonType2, $double_from2)) { $trainerDamage/=2; $opponentDamage*=2; }

        if(in_array($opponentPokemonType1, $double_to1)) { $trainerDamage*=2; $opponentDamage/=2; }
        if(in_array($opponentPokemonType1, $double_to2)) { $trainerDamage*=2; $opponentDamage/=2; }
        if(in_array($opponentPokemonType2, $double_to1)) { $trainerDamage*=2; $opponentDamage/=2; }
        if(in_array($opponentPokemonType2, $double_to2)) { $trainerDamage*=2; $opponentDamage/=2; }
        
        $turn=rand(1,2);
        if ($turn==1) {
            $opponentPokemonHP=Session::get('opponentPokemonHP');
            $opponentPokemonHP-=$trainerDamage;
            if ($opponentPokemonHP<=0) $opponentPokemonHP=0;
            Session::put('opponentPokemonHP', $opponentPokemonHP);
            if ($opponentPokemonHP>0) {
                $trainerPokemonHP=Session::get('trainerPokemonHP');
                $trainerPokemonHP-=$opponentDamage;
                if ($trainerPokemonHP<=0) $trainerPokemonHP=0;
                Session::put('trainerPokemonHP', $trainerPokemonHP);
                $message=$this->initialMessage();
                if ($trainerPokemonHP>0) {
                    return view('battles.trainerBattleAttacked', [
                        'text'=> $message,
                        'fightButtonEnable'=>'',
                        'fightLinkEnable'=>'',
                        'backButtonEnable'=>' disabled',
                        'backLinkEnable'=>'pointer-events: none'
                    ]);
                }
                else {//opponent wins 1

                    Session::put('opponentWins', Session::get('opponentWins')+1);
                    $message=$this->initialMessage();
                    $battleNumber=Session::get('battleNumber');
                    if ($battleNumber<2) {
                        Session::put('battleNumber', $battleNumber+1);
                        $this->setParametersForNextBattle(Session::get('battleNumber'));
                        $fightButtonEnable='';
                        $fightLinkEnable='';
                        $backButtonEnable=' disabled';
                        $backLinkEnable='pointer-events: none';
                    }
                    else {
                        $message.=$this->endBattle();
                        $fightButtonEnable=' disabled';
                        $fightLinkEnable='pointer-events: none';
                        $backButtonEnable='';
                        $backLinkEnable='';
                    }

                    return view('battles.trainerBattleAttacked', [
                        'text'=>$message,
                        'fightButtonEnable'=> $fightButtonEnable,
                        'fightLinkEnable'=> $fightLinkEnable,
                        'backButtonEnable'=> $backButtonEnable,
                        'backLinkEnable'=> $backLinkEnable
                    ]); 
                }
            } else {//trainer wins 1

                Session::put('trainerWins', Session::get('trainerWins')+1);
                $message=$this->initialMessage();
                $battleNumber=Session::get('battleNumber');
                if ($battleNumber<2) {
                    $message.=$this->gain($battleNumber);
                    Session::put('battleNumber', $battleNumber+1);
                    $this->setParametersForNextBattle(Session::get('battleNumber'));
                    $fightButtonEnable='';
                    $fightLinkEnable='';
                    $backButtonEnable=' disabled';
                    $backLinkEnable='pointer-events: none';
                }
                else {
                    $message.=$this->gain($battleNumber);
                    $message.=$this->endBattle();
                    $fightButtonEnable=' disabled';
                    $fightLinkEnable='pointer-events: none';
                    $backButtonEnable='';
                    $backLinkEnable='';
                }

                return view('battles.trainerBattleAttacked', [
                    'text'=>$message,
                    'fightButtonEnable'=> $fightButtonEnable,
                    'fightLinkEnable'=> $fightLinkEnable,
                    'backButtonEnable'=> $backButtonEnable,
                    'backLinkEnable'=> $backLinkEnable
                ]);
            }
        }
        else {
            $trainerPokemonHP=Session::get('trainerPokemonHP');
            $trainerPokemonHP-=$opponentDamage;
            if ($trainerPokemonHP<=0) $trainerPokemonHP=0;
            Session::put('trainerPokemonHP', $trainerPokemonHP);
            if ($trainerPokemonHP>0) {
                $opponentPokemonHP=Session::get('opponentPokemonHP');
                $opponentPokemonHP-=$trainerDamage;
                if ($opponentPokemonHP<=0) $opponentPokemonHP=0;
                Session::put('opponentPokemonHP', $opponentPokemonHP);
                $message=$this->initialMessage();
                if ($opponentPokemonHP>0) {
                    return view('battles.trainerBattleAttacked', [
                        'text'=> $message,
                        'fightButtonEnable'=>'',
                        'fightLinkEnable'=>'',
                        'backButtonEnable'=>' disabled',
                        'backLinkEnable'=>'pointer-events: none'
                    ]);
                }
                else {//trainer wins 1

                    Session::put('trainerWins', Session::get('trainerWins')+1);
                    $message=$this->initialMessage();
                    $battleNumber=Session::get('battleNumber');
                    if ($battleNumber<2) {
                        $message.=$this->gain($battleNumber);
                        Session::put('battleNumber', $battleNumber+1);
                        $this->setParametersForNextBattle(Session::get('battleNumber'));
                        $fightButtonEnable='';
                        $fightLinkEnable='';
                        $backButtonEnable=' disabled';
                        $backLinkEnable='pointer-events: none';
                    }
                    else {
                        $message.=$this->gain($battleNumber);
                        $message.=$this->endBattle();
                        $fightButtonEnable=' disabled';
                        $fightLinkEnable='pointer-events: none';
                        $backButtonEnable='';
                        $backLinkEnable='';
                    }

                    return view('battles.trainerBattleAttacked', [
                        'text'=>$message,
                        'fightButtonEnable'=> $fightButtonEnable,
                        'fightLinkEnable'=> $fightLinkEnable,
                        'backButtonEnable'=> $backButtonEnable,
                        'backLinkEnable'=> $backLinkEnable
                    ]); 
                }
            } else {//opponent wins 1

                Session::put('opponentWins', Session::get('opponentWins')+1);
                $message=$this->initialMessage();
                $battleNumber=Session::get('battleNumber');
                if ($battleNumber<2) {
                    Session::put('battleNumber', $battleNumber+1);
                    $this->setParametersForNextBattle(Session::get('battleNumber'));
                    $fightButtonEnable='';
                    $fightLinkEnable='';
                    $backButtonEnable=' disabled';
                    $backLinkEnable='pointer-events: none';
                }
                else {
                    $message.=$this->endBattle();
                    $fightButtonEnable=' disabled';
                    $fightLinkEnable='pointer-events: none';
                    $backButtonEnable='';
                    $backLinkEnable='';
                }

                return view('battles.trainerBattleAttacked', [
                    'text'=>$message,
                    'fightButtonEnable'=> $fightButtonEnable,
                    'fightLinkEnable'=> $fightLinkEnable,
                    'backButtonEnable'=> $backButtonEnable,
                    'backLinkEnable'=> $backLinkEnable
                ]); 
            }
        }
    }
}
