@extends ('battles.layout')

@section('content')

<div class="wrapperAppeared">
  <div class="headerWrapper"><h2><b>@yield('text')</b></h2></div>

  <div class="battlefield">
    <div class="me">
      <h3>{{ucfirst(Session::get('trainerPokemon'))}}</h3>
      
      <div class="secondLevelWrapper"><h5>{{"LV: ".Session::get('trainerPokemonLevel')." TYPE: ".ucfirst(Session::get('trainerPokemonType1'))." ".ucfirst(Session::get('trainerPokemonType2'))}}</h5></div>

      <img src={{ Session::get('trainerPokemonIMG') }}>

      @yield('progress1')

    </div>
    <div class="enemy">
      <h3>{{ucfirst(Session::get('opponentPokemon'))}}</h3>
      
      <div class="secondLevelWrapper"><h5>{{"LV: ".Session::get('opponentPokemonLevel')." TYPE: ".ucfirst(Session::get('opponentPokemonType1'))." ".ucfirst(Session::get('opponentPokemonType2'))}}</h5></div>

      <img src={{ Session::get('opponentPokemonIMG') }}>

      @yield('progress2')
      
    </div>

  </div>

  
  <div class="buttonArea">

      <a href="{{ route('home.index') }}" style="@yield('fightLinkEnable');"><button type="button" class="btn btn-default @yield('fightButtonEnable')">
				<img src="images-Borbe/boxing.png" height="70" />
			</button></a>

      <a href="{{ route('home.index') }}" style="@yield('pokeLinkEnable');"><button type="button" class="btn btn-default @yield('pokeButtonEnable')">
	      <img src="images-Borbe/pokeball.svg" height="70" />
      </button></a>

      <a href="{{ route('home.index') }}" style="@yield('backLinkEnable');"><button type="button" class="btn btn-default @yield('backButtonEnable')">
      <img src="images-Borbe/back.png" height="70" />
			</button></a>

    </div>


</div>

@endsection