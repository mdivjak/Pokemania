<?php
/**
 * View za prikazivanje kviza
 *
 * @author Natalija Mitić 0085/17
 *
 * @version 1.0
 */
?>

@extends('layouts.master')

@section('title')
Quiz
@endsection

@section('content')
<div id="quiz">
    <div class="row">
        <div clas="col-lg-12">
            <div id="quizContent">
                @if(Session::has('right'))
                <div class="row">
                    <div class="col-md12">
                        <p class="alert alert-success quizMsg">{{Session::get('right')[0]}}</p>
                    </div>
                </div>
                @elseif(Session::has('wrong'))
                <div class="row">
                    <div class="col-md12">
                        <p class="alert alert-danger quizMsg">{{Session::get('wrong')}}</p>
                    </div>
                </div>
                @endif
                <h1 class="shadow">Who's that pokemon?</h1>
                <br>
                <hr>
                <br>

                @if(Session::has('right'))
                <img class="correctImg" src="{{Session::get('right')[1]}}" />
                @else
                <img class="quizImg" src="{{$pokeImg}}" />
                @endif

                <br><br>
                <form action="{{ route('home.quizGuess') }}" method="post">
                    <div class="input form-group justify-content-center">
                        <!-- <div class="col-sm-2">&nbsp;</div> -->
                        <div class="col-sm-offset-3 col-sm-6 marginBottom">
                            <input {{Session::has('right') ? "disabled" : '' }} class="searchPokemon form-control" name="quizGuess" type="text" placeholder="It's..." minlength="1">
                        </div>
                        {{csrf_field()}}
                        <div class="col-sm-offset-4 col-sm-4">
                            <button {{Session::has('right') ? "disabled" : '' }} name="guess" type="submit" class="btn btn-default btn-lg">
                                <img src="{{URL::to('images/pokeball.svg')}}" height="35" />
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
</div>

@endsection