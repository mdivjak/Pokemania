@extends('layouts.master')

@section('title')
   Shop
@endsection

@section('css')
  <link rel="stylesheet" href='/css/alerts.css'>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4 col-sm-6">
      <div class="card" style="width: 50rem; height: 20rem; margin-left: 30rem;">
        <img class="card-img-top pokemon-image column is-two-thirds" height="250" width="250" src="/images/ash.png" alt="Card image cap">
      </div>
    </div>

    <div class="col-lg-4 col-sm-6">
      <div class="card" style="width: 50rem; height: 20rem; margin-top: 10rem; margin-left: 30rem;">
        <div class="card-body">
          <h2 class="card-title">{{ $user->nickname }}</h2>
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
      <h3 class="moves-title title">EQUIPMENT</h3>
    </div>
  </div>

  @if (session()->has('message'))
    <div class="col-sm-12 alert-message">
      <span class="alert alert-success">{{ session()->get('message') }}</span>
    </div>
  @endif

  @if (session()->has('message_danger'))
    <div class="col-sm-12 alert-message">
      <span class="alert alert-danger">{{ session()->get('message_danger') }}</span>
    </div>
  @endif

  <div class="row" style="margin-top: 10rem;">

    <div class="col-lg-6 col-sm-6">
      <div class="moves container">
        <div class="thumbnail" style="width: 20rem; height: 22rem;">
          <div class="caption">
            <p class="move-name"> POKEBALL </p>
            <img width=70 height=70 src="/images/pokeball.png" style="margin-left:50px;"/>

            <div style="margin-top:30px; margin-left:4rem;">
                <form method='POST' action='/profile/1/shop?buy=pokeball'>
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Buy for 50ß</a>
                </form> 
            </div>           

          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-sm-6">
      <div class="moves container">
        <div class="thumbnail" style="width: 20rem; height: 22rem;">
          <div class="caption">
            <p class="move-name"> FRUIT </p>
            <img width=70 height=70 src="/images/fruit.png" style="margin-left:50px;"/>

            <div style="margin-top:30px; margin-left:4rem;">
                <form method='POST' action='/profile/1/shop?buy=fruit'>
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Buy for 50ß</a>
                </form> 
            </div>   

          </div>
        </div>
      </div>
    </div>

  </div>

  </div>
@endsection