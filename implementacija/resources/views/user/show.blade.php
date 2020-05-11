@extends('layouts.master')

@section('title')
   Profile
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4 col-sm-6">
      <div class="card" style="width: 50rem; height: 20rem; margin-left: 30rem;">
        <img class="card-img-top pokemon-image column is-two-thirds" height="250" width="250" src="{{ asset('images/ash.png') }}" alt="Card image cap">
      </div>
    </div>

    <div class="col-lg-4 col-sm-6">
      <div class="card" style="width: 50rem; height: 20rem; margin-top: 10rem; margin-left: 30rem;">
        <div class="card-body">
          <h2 class="card-title">{{ $user->name }}</h2>
          <h4 class="card-text">Pokemons: {{ $user->cntPokemons }}</h4>
          <h4 class="card-text">Pokecash: {{ $user->cntCash }} ß</h4>
          <h4 class="card-text">Pokeballs: {{ $user->cntBalls }}</h4>
          <h4 class="card-text">Fruits: {{ $user->cntFruits }}</h4>
        </div>
      </div>
    </div>
  </div>

  <br>
  <hr class="styled" />

  <div class="col-lg-2 col-sm-2 ">
    <div class="container">
      <h3 class="moves-title title">POKEMONS</h3>
    </div>
  </div>
  
  @if (session()->has('message'))
    <div class="col-sm-12 alert-message">
      <div class="alert alert-success">{{ session()->get('message') }}</div>
    </div>
  @endif

  <div class="row" style="margin-top: 10rem;">

  @foreach($collection as $data)
    <div class="col-md-3 col-sm-12">
      <div class="pokemons container">
        <div class="thumbnail" style="width: 20rem; height: 27rem;">
          <div class="caption">
            <p class="pokemon-name"> {{ strtoupper(App\Pokemon::find($data->first()->pokemon_id)->getName()) }} </p>
            <img width=70 height=70 src=" {{ App\Pokemon::find($data->first()->pokemon_id)->getImage() }} "/>
            <p class=" move-power"> <b>Level :</b> {{  $data->first()->level }} </p>
            <p class=" move-accuracy"><b>XP:</b> {{  $data->first()->xp }}
              <div class="progress">
                <div class="progress-bar" role="progressbar" 
                  aria-valuenow="13" aria-valuemin="0" 
                  aria-valuemax="35" 
                  style="width: 37%;"
                >
                  <span class="sr-only">37% Complete</span>
                </div>
              </div>
            </p>
            <div>
              <form method='POST' action='{{ route("user.feed", ["id" => Auth::user()->idU]) }}?pokemon={{ $data->first()->pokemon_id }}' style="float:left;">
                @csrf
                @method('PUT')
                <button type='submit' class="btn btn-primary @if($user->cntFruits==0) disabled @endif">Feed</a>
              </form>

              <form method='POST' action='{{ route("user.release", ["id" => Auth::user()->idU]) }}?pokemon={{ $data->first()->pokemon_id }}' style="float:left;">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary" style="float:right;">Let Go</a>
              </form>              
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach

  </div>
@endsection