@extends ('battles.layout')

@section('content')

<div class="wrapperAppeared">
  <div class="headerWrapper"><h3 style="font-weight:bold;">A wild {{ ucfirst($pokemonName) }} appeared!</h3></div>
  <img src={{$imageURI}}>
  <div class="levelWrapper"><h5>LV: {{$pokemonLevel}}</h5></div>
  <div class="headerWrapper"><h2 style="font-weight:bold;">Choose your Pokemon!</h2></div>
  <form action="{{ route('wildBattlePick') }}" method="post">
  @csrf
  <ul class="list-group">
        @foreach ($trainersPokemons as $index => $value)
        <div class="trainerPokemonHolder">
          <input class="btn btn-primary" type="submit" style="width: 130px; height: 34px; font-weight:bold;" value="{{ucfirst($value)}}" name="action">
          <input class="btn btn-danger" style="pointer-events: none; width: 70px; height: 34px; font-weight:bold;" value="LV: {{ucfirst($trainersPokemonsLevelsForButtons[$index])}}">
        </div>
        @endforeach
  </ul>
  </form>
</div>

@endsection

