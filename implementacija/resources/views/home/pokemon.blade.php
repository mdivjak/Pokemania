@extends('layouts.master')

@section('scripts')
<script src="{{URL::to('js/pokemon.js')}}"></script>
@endsection

@section('content')
<div id="pokemon">

    <div class="loading">
        <img src="{{ URL::to('images/loading.gif')}}" alt="">
        <h2>Loading Pokemon...</h2>
    </div>

    <div class="response">
        <div class="row">
            <div class="col-xs-12">
                <div class="pokeName">
                    
                </div>
            </div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-sm-6 text-right specsImg">
                
            </div>
            <div class="col-sm-6 text-left specs">
                <div class="pokemon-card">
                    <p class="card-text">Basic info:</p>
                    <p class="card-text">Weight: <span id="weight"></span> kg</p>
                    <p class="card-text">Height: <span id="height"></span> m</p>
                    <p class="card-text">
                        Type(s):
                        <div class="row ">
                            <div class="col-xs-12" id="typesList">
                                
                            </div>
                        </div>
                    </p>
                </div>
            </div>
        </div>
        <br><br><br><br>

        <div class="row">
            <div class="col-xs-12">
                <div class="container">
                    <h2 class="moves-title title">Moves</h2>
                    <br><br>
                    <div class="row text-center" id="movesList">

                    </div>
                </div>
            </div>
        </div>
    </div>




</div>

<div class="container pointers">
    <a class="btn btn-primary" href="{{route('home.pokemon', ['id' => ($id > 1 ? $id - 1 : env('MAX_POKEMONS'))])}}">Prev</a>
    <a class="btn btn-primary" href="{{route('home.pokemon', ['id' => ($id < env('MAX_POKEMONS') ? $id + 1 : 1)])}}">Next</a>
</div>
@endsection