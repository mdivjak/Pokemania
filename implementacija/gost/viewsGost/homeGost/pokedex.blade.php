@extends('layouts.master')

@section('title')
Pokedex
@endsection

@section('scripts')
<script src="{{ URL::to('js/pokedex.js') }}"></script>
@endsection

@section('content')
<div id="pokedex">

            <div class="row">
                <div class="col-sm-offset-3 col-sm-6">
                    <input id="searchPokedex" onkeyup="search()" type="search" placeholder="Search Pokemon" ng-model="filterText"
                        class="searchPokemon form-control">
                    <br><br>
                </div>
            </div>

            <div id="pokedexDisplay" class="row marginBottom">
                <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

                @foreach($pokemons as $pokemon)
                <div class="col-lg-4 col-sm-6">
                    <div class="pokemon-card">
                        <a href="{{route('home.pokemon', ['id' => $pokemon['id']])}}">
                            <div class="pokeName"><span>#{{$pokemon['id']}}</span> {{$pokemon['name']}}</div>
                            <img class="image" src="{{$pokemon['img']}}">
                        </a>
                    </div>
                </div>
                @endforeach
                
            </div>
</div>
@endsection