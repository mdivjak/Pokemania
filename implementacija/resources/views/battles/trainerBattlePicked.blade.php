<?php
/**
 * Početni view pri biranju pokemona u borbi na turniru
 * 
 * @author Vukašin Drašković 0455/17
 *
 * @version 1.0
 */
?>

@extends ('battles.layout2')

@section('text')
{{$text}}
@endsection

@section('progress1')
<div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar"
          aria-valuemin="0" aria-valuemax="100" style="width:100%">
            <b>HP:&nbsp;{{Session::get('trainerPokemonMaxHP')}}</b>
        </div>
</div>
@endsection

@section('progress2')
<div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar"
          aria-valuemin="0" aria-valuemax="100" style="width:100%">
            <b>HP:&nbsp;{{Session::get('opponentPokemonMaxHP')}}</b>
        </div>
</div>
@endsection

@section('fightLinkEnable')
@endsection

@section('backLinkEnable')
pointer-events: none
@endsection

@section('fightButtonEnable')
@endsection

@section('backButtonEnable')
disabled
@endsection

