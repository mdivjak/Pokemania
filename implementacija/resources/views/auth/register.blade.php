@extends('layouts.master')

@section('title')
Register
@endsection


@section('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection

<?php $fast = count($errors) > 0; ?>


@section('content')
<div id="auth">
    <div class="wrapper {{$fast ? '' : 'fadeInDown'}}">
        <div id="formContent">
            <br>
            <form class="loginForm" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row {{$fast ? '' : 'fadeIn first'}}">
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nickname">

                    @error('name')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>

                <div class="form-group row {{$fast ? '' : 'fadeIn second'}}">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                    @error('email')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>

                <div class="form-group row {{$fast ? '' : 'fadeIn third'}}">

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                    @error('password')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>

                <div class="form-group row {{$fast ? '' : 'fadeIn fourth'}}">

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">

                </div>

                <div class="form-group row mb-0 {{$fast ? '' : 'fadeIn fifth'}}">
                    <input type="submit" class="btn btn-primary" value=" {{ __('Register') }}">

                </div>
                <br>
            </form>
        </div>
    </div>
</div>


@endsection