@extends('layouts.master')

@section('title')
   Tournaments
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
<div id="tournament">

  <div class="row" style="margin-top: 10rem;">
    <div class="col-lg-2 col-sm-2 ">
      <div class="container">
        <h3 class="moves-title title">TOURNAMENTS</h3>
      </div>
    </div>
  </div>

  @if (session()->has('message'))
    <div class="col-sm-12 alert-message">
      <div class="alert alert-danger">{{ session()->get('message') }}</div>
    </div>
  @endif

  @if (session()->has('message_success'))
    <div class="col-sm-12 alert-message">
      <div class="alert alert-success">{{ session()->get('message_success') }}</div>
    </div>
  @endif

  <div class="row" style="margin-top: 3rem;">

    @foreach($tournaments as $tournament)
    <div class="col-lg-3 col-sm-6">
      <div class="pokemons container">
        <div class="pokemon-card" style="width: 22rem; height: 27rem; display: flex; align-items: center;">
          <div class="caption" style="margin: auto">
            <p class="move-name">{{ $tournament->name }}</p>
            <p class=" move-power"> <b>Prize :</b> {{ $tournament->prize }} ₽ </p>

            <p class=" move-power"> <b>Min Level :</b> {{ $tournament->minLevel }} </p>
            <p class=" move-accuracy"><b>Max Level:</b> {{ $tournament->maxLevel }} </p>
            <p class=" move-accuracy"><b>End Date:</b> {{ date('d.m.Y', strtotime($tournament->endDate)) }} </p>
            
            <div style="margin-top: 2rem;">
              @if(Auth::user()->participates($tournament->id))
                
                <form method='GET' action='{{ route("tournament.show", $tournament->id) }}'>
                  <button type="submit" class="btn btn-success mb-3">Show details</button>
                </form> 

              @elseif(Auth::user()->isRegistered($tournament->id)) 

                <p class='text-danger'>Waiting for admin to accept...</p>

              @else
                
                <form method='POST' action='{{ route("tournament.store", $tournament->id) }}'>
                  @csrf
                  <button type="submit" 
                    class="btn btn-primary mb-3"
                  >
                    Register for {{ $tournament->entryFee }} ₽
                  </button>
                </form> 

              @endif
              
            </div>   

          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection