<?php
/**
 * View za prikazivanje početne strane
 *
 * @author Natalija Mitić 0085/17
 *
 * @version 1.0
 */
?>

@extends('layouts.master')

@section('title')
   Home
@endsection

@section('content')
    <div class="row">
        <div clas="col-lg-12">
            <div id="homeContent">
                <h1>Pokemania</h1>
                <h3>Made with ❤️ by Disciplinovani</h3>
                <hr>
                <form action="@guest {{ route('login') }} @else {{ route('wildBattle') }} @endguest" method="get">
                    <button type="submit" class="btn btn-default btn-lg">
                        <img src="{{URL::to('images/pokeball.svg')}}" height="35" />
                        @guest
                            Get Started!
                        @else
                            Catch 'em all!
                        @endguest
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection