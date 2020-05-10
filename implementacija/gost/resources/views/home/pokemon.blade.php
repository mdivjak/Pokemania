@extends('layouts.master')

@section('title')
{{ucfirst($name)}}
@endsection

@section('content')
<div id="pokemon">
    <div class="row">
        <div class="col-xs-12">
            <div class="pokeName">
                <h1><span>#{{$id}}</span>&nbsp;&nbsp;{{$name}}</h1>
            </div>
        </div>
    </div>
    <br><br><br>
    <div class="row">
        <div class="col-sm-6 text-right specsImg">
            <img class="pokemon-image" height="300" width="300" src="https://pokeres.bastionbot.org/images/pokemon/{{$id}}.png" alt="Card image cap">
        </div>
        <div class="col-sm-6 text-left specs">
            <div class="pokemon-card">
                <p class="card-text">Basic info:</p>
                <p class="card-text">Weight: {{$weight}} kg</p>
                <p class="card-text">Height: {{$height}} m</p>
                <p class="card-text">
                    Type(s):
                    <div class="row ">
                        <div class="col-xs-12 ">
                            @foreach ($types as $type)
                            <span class="type {{$type['name']}}"> {{$type['name']}} </span>
                            @endforeach
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
                <div class="row text-center">

                    @foreach ($moves as $move)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="thumbnail moves" style="width: 20rem; height: 24rem;">
                            <div class="caption">
                                <p class="move-name"> {{$move['name']}}&nbsp;&nbsp;

                                @if ($move['damage_class'] == "status")
                                    <img class="icon damage" src="{{ URL::to('images/statusMove.svg') }}"></img>
                                @elseif ($move['damage_class'] == "special")
                                    <img class="icon damage" src="{{ URL::to('images/specialMove.svg') }}"></img>
                                @else
                                    <img class="icon damage" src="{{ URL::to('images/physicalMove.svg') }}"></img>
                                @endif
                                </p>
                                <p class=" move-power"> <b>Power :</b> {{$move['power']}} </p>
                                <p class=" move-accuracy"><b>Acc:</b> {{$move['accuracy']}} %
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$move['accuracy']}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$move['accuracy']}}%;">
                                            <span class="sr-only">{{$move['accuracy']}}% Accuracy</span>
                                        </div>
                                    </div>
                                </p>
                                <p class=" move-pp"> <b>PP:</b> {{$move['pp']}} </p>
                                <p class="move-damage-class"></p>
                                <p class=" move-type">
                                    <span class="type {{$move['type']}}"> {{$move['type']}} </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach


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