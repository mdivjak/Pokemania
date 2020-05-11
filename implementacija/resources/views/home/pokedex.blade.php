@extends('layouts.master')

@section('title')
Pokedex
@endsection

@section('scripts')
<script src="{{ URL::to('js/pokedex.js') }}"></script>
@endsection

@section('content')
<div id="pokedex">
    <div class="loading">
        <img src="{{ URL::to('images/loading.gif')}}" alt="">
        <h2>Loading Pokedex...</h2>
    </div>

    <div class="response">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <input id="searchPokedex" onkeyup="search()" type="search" placeholder="Search Pokemon" ng-model="filterText" class="searchPokemon form-control">
                <br><br>
            </div>
        </div>

        <div id="pokedexDisplay" class="row marginBottom">
            <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

        </div>
    </div>

</div>
@endsection