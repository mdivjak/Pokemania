@extends ('layout1')

@section('text')
Battle!
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
            <b>HP:&nbsp;{{Session::get('wildPokemonMaxHP')}}</b>
        </div>
</div>
@endsection

@section('fightButtonEnable')
@endsection

@section('pokeButtonEnable')
disabled
@endsection