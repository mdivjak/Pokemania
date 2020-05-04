@extends('layouts.master')

@section('title')
Quiz
@endsection

@section('content')
<div class="row">
    <div clas="col-lg-12">
        <div id="content">
            @if(Session::has('success'))
            <div class="row">
                <div class="col-md12">
                    <p class="alert alert-success quizMsg">{{Session::get('success')[0]}}</p>
                </div>
            </div>
            @elseif(Session::has('wrong'))
            <div class="row">
                <div class="col-md12">
                    <p class="alert alert-danger quizMsg">{{Session::get('wrong')}}</p>
                </div>
            </div>
            @endif
            <h2>Guess the Pokemon!</h2>
            <hr>

            @if(Session::has('success'))
            <img class="correctImg" src="{{Session::get('success')[1]}}" />
            @else
            <img class="quizImg" src="{{$pokeImg}}" />
            @endif
            
            <hr />
            <form action="{{ route('home.quizGuess') }}" method="post">
                <div class="input form-group justify-content-center">
                    <div class="col-sm-2">&nbsp;</div>
                    <div class="col-sm-5">
                        <input {{Session::has('success') ? "disabled" : '' }} class="searchPokemon form-control" name="quizGuess" type="text" placeholder="It's..." minlength="1">
                    </div>
                    {{csrf_field()}}
                    <div class="col-sm-4">
                        <button {{Session::has('success') ? "disabled" : '' }} name="guess" type="submit" class="btn btn-default btn-lg">
                            <img src="{{URL::to('images/pokeball.svg')}}" height="25" />
                            submit
                        </button>
                        <button name="refresh" class="btn btn-default btn-lg">
                           <i class="fas fa-redo"></i>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection