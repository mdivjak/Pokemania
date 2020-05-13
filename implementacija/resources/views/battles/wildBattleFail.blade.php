@extends ('battles.layout')

@section('part')
Wild Battle
@endsection

@section('content')

<div id="aroundBattle">

<div class="wrapperAppeared">
  <div class="headerWrapper"><h3 style="font-weight:bold;">A wild {{ ucfirst($pokemonName) }} appeared!</h3></div>
  <img src={{$imageURI}}>
  <div class="levelWrapper"><h5>LV: {{$pokemonLevel}}</h5></div>
  <div class="headerWrapper"><h2 style="font-weight:bold;">You don't have any Pokemons!</h2></div>
</div>

</div>

@endsection

