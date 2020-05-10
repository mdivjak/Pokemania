@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row">
        <div class="col-lg-12 text-center mt-5">
            <div id="content">
                <h1>Pokemania</h1>
                <h3>Made with ❤️ by Disciplinovani</h3>
                <hr>
                <button onclick="location.href='{{ route('login') }}'" type="button" class="btn btn-default btn-lg btn-outline-primary">
                    <img src="{{ asset('images/pokeball.svg') }}" height="35" />
                    Get Started!
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
