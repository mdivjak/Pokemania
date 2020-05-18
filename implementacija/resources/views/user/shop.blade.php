<?php
/**
 * View za prikazivanje kupovine u prodavnici
 *
 * @author Anja Marković 0420/17, Natalija Mitić 0085/17
 *
 * @version 1.0
 */
?>

@extends('layouts.master')

@section('title')
   Shop
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
<div id="shop">

  <div class="row">
    <div class="col-lg-4 col-sm-6">
      <div class="card">
        <img height="250" width="250" src="{{ asset('images/avatars/avatar'.$user->avatar.'.png') }}" alt="Card image cap">
      </div>
    </div>

    <div class="col-lg-4 col-sm-6">
      <div class="card" style="margin-top:5rem">
        <div class="card-body">
          <h2 class="card-title">{{ $user->name }}</h2>
          <h4 class="card-text">Pokemons: {{ $user->cntPokemons }}</h4>
          <h4 class="card-text">Pokecash: {{ $user->cntCash }} ₽</h4>
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
      <div class="alert alert-success">{{ session()->get('message') }}</div>
    </div>
  @endif

  @if (session()->has('message_danger'))
    <div class="col-sm-12 alert-message">
      <div class="alert alert-danger">{{ session()->get('message_danger') }}</div>
    </div>
  @endif

  <div class="row" style="margin-top: 10rem;">

    <div class="col-lg-6 col-sm-6">
      <div class="pokemons container">
        <div class="pokemon-card" style="width: 20rem; height: 22rem;">
          <div class="caption">
            <p class="pokemon-name"> POKEBALL </p>
            <img width=70 height=70 src="{{ asset('images/pokeball.png') }}"/>

            <div style="margin-top:30px;">
                <form method='POST' action='{{ route("user.shop", Auth::user()) }}?buy=pokeball'>
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Buy for 50₽</a>
                </form> 
            </div>           

          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-sm-6">
      <div class="pokemons container">
        <div class="pokemon-card" style="width: 20rem; height: 22rem;">
          <div class="caption">
            <p class="pokemon-name"> FRUIT </p>
            <img width=70 height=70 src="{{ asset('images/fruit.png') }}"/>

            <div style="margin-top:30px;">
                <form method='POST' action='{{ route("user.shop", Auth::user()) }}?buy=fruit'>
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Buy for 50₽</a>
                </form> 
            </div>   

          </div>
        </div>
      </div>
    </div>

  </div>
  </div>
</div>
@endsection