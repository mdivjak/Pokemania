<?php
/**
 * View za biranje pokemona u borbi na turniru
 *
 * @author Vukašin Drašković 0455/17
 *
 * @version 1.0
 */
?>

@extends ('battles.layout')

@section('part')
Torunament Battle
@endsection

@section('content')

<div id="aroundBattle">

<div class="wrapperAppeared">
  <div class="headerWrapper"><h3 style="font-weight:bold;">Your opponent is {{$opponentNick}}!</h3></div>
  <img src="images-Borbe/trainerBattlePokeball.png">
  <div class="headerWrapper"><h2 style="font-weight:bold;">{{$text}}</h2></div>
  <form action="{{ route('trainerBattlePick') }}" method="post" style="text-align: center;">
  @csrf
    <div class="form-check">
        <div class="checkboxHolder">
            @foreach ($trainerPokemons as $index => $pokemon)
              <div class="availablePokemonHolder">
                <input class="form-check-input" type="checkbox" name="picked[]" value="{{$trainerPokemonsIDs[$index]}}" style="width: 23px; height: 23px; vertical-align: middle;">
                <input class="btn btn-primary"style="width: 130px; height: 34px; font-weight:bold; pointer-events: none;" value="{{ucfirst($pokemon)}}" name="action">  
                <input class="btn btn-danger" style="pointer-events: none; width: 70px; height: 34px; font-weight:bold;" value="LV: {{ucfirst($trainerPokemonsLevelsForButtons[$index])}}">
              </div>
            @endforeach
        </div>
    </div>
    <input class="btn btn-warning" type="submit" style="width: 130px; height: 34px; font-weight:bold;" value="Battle!" name="action">
  </form>
</div>

</div>

@endsection