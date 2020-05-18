<?php
/**
 * View za napadanje u borbi na turniru 
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
          aria-valuemin="0" aria-valuemax="100" style="width:{{Session::get('trainerPokemonHP')/Session::get('trainerPokemonMaxHP')*100}}%">
            <b>HP:&nbsp;{{Session::get('trainerPokemonHP')}}</b>
        </div>
</div>
@endsection

@section('progress2')
<div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar"
          aria-valuemin="0" aria-valuemax="100" style="width:{{Session::get('opponentPokemonHP')/Session::get('opponentPokemonMaxHP')*100}}%">
          <b>HP:&nbsp;{{Session::get('opponentPokemonHP')}}</b>
        </div>
</div>
@endsection

@section('fightLinkEnable')
{{$fightLinkEnable}}
@endsection

@section('backLinkEnable')
{{$backLinkEnable}}
@endsection

@section('fightButtonEnable')
{{$fightButtonEnable}}
@endsection

@section('backButtonEnable')
{{$backButtonEnable}}
@endsection