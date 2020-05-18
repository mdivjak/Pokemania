<?php
/**
 * Layout za borbu sa divljim pokemonom
 *
 * @author Vukašin Drašković 0455/17
 *
 * @version 1.0
 */
?>

@extends('battles.layout')

@section('part')
Wild Battle
@endsection

@section('contents')

<div id="aroundBattle">

<div class="wrapperAppeared">
  <div class="headerWrapper" style="vertical-align: middle;"><h2><b>@yield('text')</b></h2></div>

  <div class="battlefield">
    <div class="me">
      <h3 style="display: inline-block; vertical-align: middle; margin-top: 14px;">{{ucfirst(Session::get('trainerPokemon'))}}</h3>
      <div class="secondLevelWrapper"><h5>{{"LV: ".Session::get('trainerPokemonLevel')}}</h5></div>
      
      <div class="infoInBattle">
        
        <span class="{{Session::get('trainerPokemonType1')}}" style="width: 30%; padding: 5px; border-radius: 10px; margin: auto; margin-right: 2px;"><b>{{strtoupper(Session::get('trainerPokemonType1'))}}</b></span>
        <span class="{{Session::get('trainerPokemonType2')}}" style="width: 30%; padding: 5px; border-radius: 10px; margin: auto; margin-left: 2px;"><b>{{strtoupper(Session::get('trainerPokemonType2'))}}</b></span>
      </div>
        
      <img src={{ Session::get('trainerPokemonIMG') }}>

      @yield('progress1')

    </div>
    <div class="enemy">
    <h3 style="display: inline-block; vertical-align: middle; margin-top: 14px;">{{ucfirst(Session::get('wildPokemon'))}}</h3>
      <div class="secondLevelWrapper"><h5>{{"LV: ".Session::get('wildPokemonLevel')}}</h5></div>
      
      <div class="infoInBattle">
        
        <span class="{{Session::get('wildPokemonType1')}}" style="width: 30%; padding: 5px; border-radius: 10px; margin: auto; margin-right: 2px;"><b>{{strtoupper(Session::get('wildPokemonType1'))}}</b></span>
        <span class="{{Session::get('wildPokemonType2')}}" style="width: 30%; padding: 5px; border-radius: 10px; margin: auto; margin-left: 2px;"><b>{{strtoupper(Session::get('wildPokemonType2'))}}</b></span>
      </div>

      <img src={{ Session::get('wildPokemonIMG') }}>

      @yield('progress2')
      
    </div>

  </div>

  
  <div class="buttonArea">

      <a href="{{ route('wildBattleAttack') }}" style="@yield('fightLinkEnable');"><button type="button" class="btn btn-default @yield('fightButtonEnable')">
				<img src="images-Borbe/boxing.png" height="70" />
			</button></a>

      <a href="{{ route('wildBattleCatch') }}" style="@yield('pokeLinkEnable');"><button type="button" class="btn btn-default @yield('pokeButtonEnable')">
	      <img src="images-Borbe/pokeball.svg" height="70" />
      </button></a>

      <a href="{{ route('user.show', Auth::user()->name) }}" style="@yield('backLinkEnable');"><button type="button" class="btn btn-default @yield('backButtonEnable')">
      <img src="images-Borbe/back.png" height="70" />
			</button></a>

    </div>


</div>

</div>

@endsection