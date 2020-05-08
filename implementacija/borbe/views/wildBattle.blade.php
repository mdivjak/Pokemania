@extends ('layout')

@section('content')

<div class="wrapperAppeared">
  <div class="headerWrapper"><h3>A wild {{ ucfirst($pokemonName) }} appeared!</h3></div>
  <img src={{$imageURI}}>
  <div class="levelWrapper"><h5>LV: {{$pokemonLevel}}</h5></div>
  <div class="headerWrapper"><h2>Choose your Pokemon!</h2></div>
  <form action="{{ route('wildBattlePick') }}" method="post">
  @csrf
  <ul class="list-group">
        @foreach ($trainersPokemons as $index => $value)
        <input class="btn btn-primary" type="submit" value="{{ucfirst($value)}}" name="action">
        @endforeach
  </ul>
  </form>
</div>

@endsection

