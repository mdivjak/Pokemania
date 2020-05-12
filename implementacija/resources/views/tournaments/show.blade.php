@extends('layouts.master')

@section('title')
   Tournaments
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/user.css') }}">
  <script src="https://kit.fontawesome.com/225aeb8e22.js" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="top10">

    <div class="row" style="margin-top: 10rem;">
        <div class="col-lg-12 col-sm-12 ">
            <div class="container">
                <h3 class="moves-title title">LEADERBOARD</h3>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="row">
            <div class="col-sm-12 alert-message">
                <div class="container">
                    <div class="alert alert-danger">{{ session()->get('message') }}</div>
                </div>
            </div>
        </div>
    @endif
        
    <div class="row">
        <div class="col-lg-2 col-sm-12 ">
            <div class="tournaments container">
                <div class="pokemon-card" style="width: 20rem; height: 22rem;">
                    <div class="caption">
                        <p class="move-name"> {{ $tournament->name }} </p>
                        <br />
                        <p class=" move-power"> <b>Prize :</b> {{ $tournament->prize }} ₽ </p>
                        <p class=" move-power"> <b>Min Level :</b> {{ $tournament->minLevel }} </p>
                        <p class=" move-accuracy"><b>Max Level:</b> {{ $tournament->maxLevel }} </p>
                        <p class=" move-accuracy"><b>End Date:</b> {{ date('d.m.Y', strtotime($tournament->endDate)) }} </p>
                    </div>
                </div>
            </div>

            @if (!$tournament->ifTop10(Auth::user()))
                <div class="tournaments container">
                    <div class="tournament-card" style="width: 20rem; height: 5rem;">
                        <div class="alert-message">
                            <p class="alert alert-danger" style="margin-top:1rem"> You are not in top 10! </p>
                        </div>
                    </div>
                </div>   
            @endif     

        </div>

        <div class="col-lg-8 col-sm-12">
            <div id="leaderboards">
                <ul class="toplist">
                    @foreach($tournament->topParticipants as $index => $participant)
                        <li data-rank='{{ $index + 1 }}'>
                            <div class="thumb">
                                <a href="{{ route('user.show', $participant) }}">
                                    @if ($participant->idU == Auth::id())
                                        <span class="auth_name">{{ $participant->name }}</span>                                
                                    @else 
                                        <span class="toplist_name">{{ $participant->name }}</span>
                                    @endif
                                </a> 
                                <span class="stat"><b>{{ $participant->cntWins($tournament->id) }}</b>Wins</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
    </div>

    <div class="container" style="padding-top: 2rem">
        <div class="row">
            <div clas="col-sm-12">
                <div class='form-buttons'>
                    
                    @if (Auth::user()->hasEnoughPokemons($tournament))
                    <form method='GET' action='{{ route("trainerBattle") }}' style='display: inline-block'>
                        @csrf
                        <button type="submit" class="btn btn-default btn-lg" style='margin: 1em'>
                            <img src="{{ asset('images/boxing.png') }}" height="65" />
                        </button>
                    </form>
                    @else 
                        <button class="btn btn-default btn-lg disabled" style='margin: 1em'>
                            <img src="{{ asset('images/boxing.png') }}" height="65" />
                        </button>
                    @endif

                    <form method='POST' action='{{ route("tournament.delete", $tournament->id) }}' style='display: inline-block'>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-default btn-lg" style='margin: 1em'>
                            <h2>Leave</h2>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection