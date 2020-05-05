@extends('layouts.master')

@section('title')
   Home
@endsection

@section('content')
    <div class="row">
        <div clas="col-lg-12">
            <div id="content">
                <h1>Pokemania</h1>
                <h3>Made with ❤️ by Disciplinovani</h3>
                <hr>
                <button onclick="location.href='login.html'" type="button" class="btn btn-default btn-lg">
                    <img src="{{URL::to('images/pokeball.svg')}}" height="35" />
                    Get Started!
                </button>
            </div>
        </div>
    </div>
@endsection