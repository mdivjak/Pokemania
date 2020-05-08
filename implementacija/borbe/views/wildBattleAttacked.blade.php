@extends ('layout1')

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
          aria-valuemin="0" aria-valuemax="100" style="width:{{Session::get('wildPokemonHP')/Session::get('wildPokemonMaxHP')*100}}%">
          <b>HP:&nbsp;{{Session::get('wildPokemonHP')}}</b>
        </div>
</div>
@endsection

@section('fightButtonEnable')
{{$fightButtonEnable}}
@endsection

@section('pokeButtonEnable')
{{$pokeButtonEnable}}
@endsection