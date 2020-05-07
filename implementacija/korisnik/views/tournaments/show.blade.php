@extends('layouts.master')

@section('title')
   Tournaments
@endsection

@section('css')
  <link rel="stylesheet" href='/css/alerts.css'>
  <script src="https://kit.fontawesome.com/225aeb8e22.js" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="top10">
        
    <div class="row">
        <div class="col-lg-2 col-sm-2 ">
        <div class="moves container">
            <div class="thumbnail" style="width: 20rem; height: 22rem;">
            <div class="caption">
                <p class="move-name"> {{ $tournament->name }} </p>
                <br />
                <p class=" move-power"> <b>Prize :</b> {{ $tournament->prize }} ß </p>
                <p class=" move-power"> <b>Min Level :</b> {{ $tournament->minLevel }} </p>
                <p class=" move-accuracy"><b>Max Level:</b> {{ $tournament->maxLevel }} </p>
                <p class=" move-accuracy"><b>End Date:</b> {{ date('d.m.Y', strtotime($tournament->endDate)) }} </p>

            </div>
            </div>
        </div>
        </div>


        <div id="leaderboards">
            <ul class="toplist">
                @foreach($tournament->topParticipants as $index => $participant)
                    <li data-rank='{{ $index + 1 }}'>
                        <div class="thumb">
                            <a><span class="name">{{ $participant->nickname }}</span> </a>
                            <span class="stat"><b>{{ $participant->cntWins($tournament->id) }}</b>Wins</span>
                        </div>
                        <div class="more">
                        <!-- To be designed & implemented -->
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="container" style="padding-top: 2rem">
        <div class="row">
            <div clas="col-sm-12">
                <div class='form-buttons'>
                    
                    @if (App\User::find(1)->hasEnoughPokemons($tournament))
                    <form method='POST' action='' style='display: inline-block'>
                        @csrf
                         <!-- Auth::user() -->
                        <button type="submit" class="btn btn-default btn-lg" style='margin: 1em'>
                            <img src="/images/boxing.png" height="65" />
                        </button>
                    </form>
                    @else 
                        <button class="btn btn-default btn-lg disabled" style='margin: 1em'>
                            <img src="/images/boxing.png" height="65" />
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