@extends ('layout')

@section('content')

<div class="wrapperAppeared">
  <div class="headerWrapper"><h2><b>Battle!</b></h2></div>

  <div class="battlefield">
    <div class="me">
      <h3>{{ucfirst($trainerPokemonName)}}</h3>
      
      <div class="secondLevelWrapper"><h5>{{"LV: ".$trainerPokemonLevel." TYPE: ".ucfirst($trainerPokemonType1)." ".ucfirst($trainerPokemonType2)}}</h5></div>

      <img src={{$trainerPokemonIMG}}>

      <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
        aria-valuemin="0" aria-valuemax="100" style="width:100%">
          HP
        </div>
      </div>

    </div>
    <div class="enemy">
      <h3>{{ucfirst($wildPokemonName)}}</h3>
      
      <div class="secondLevelWrapper"><h5>{{"LV: ".$wildPokemonLevel."\nTYPE: ".ucfirst($wildPokemonType1)." ".ucfirst($wildPokemonType2)}}</h5></div>

      <img src={{$wildPokemonIMG}}>

      <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
        aria-valuemin="0" aria-valuemax="100" style="width:100%">
          HP
        </div>
      </div>
      
    </div>

  </div>

  
  <div class="buttonArea">
      <button type="button" class="btn btn-default">
				<img src="images-Borbe/boxing.png" height="70" />
			</button>
      <button type="button" class="btn btn-default">
				<img src="images-Borbe/pokeball.svg" height="70" />
			</button>
    </div>


</div>

@endsection