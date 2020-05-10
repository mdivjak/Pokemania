@extends ('battles.layout1')

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
            <b>HP:&nbsp;{{Session::get('wildPokemonMaxHP')}}</b>
        </div>
</div>
@endsection

@section('fightLinkEnable')
@endsection

@section('pokeLinkEnable')
pointer-events: none
@endsection

@section('backLinkEnable')
pointer-events: none
@endsection

@section('fightButtonEnable')
@endsection

@section('pokeButtonEnable')
disabled
@endsection

@section('backButtonEnable')
disabled
@endsection

