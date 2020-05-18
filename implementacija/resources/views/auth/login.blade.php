<?php
/**
 * View za logovanje korisnika
 *
 * @author Natalija Mitić 0085/17
 *
 * @version 1.0
 */
?>

@extends('layouts.master')

@section('title')
Login
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
            <form class="loginForm" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row {{$fast ? '' : 'fadeIn first'}}">
                    <input type="text" id="login" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="login" value="{{ old('username') ?: old('email') }}" required autofocus placeholder="Email / Username">

                    @if ($errors->has('username') || $errors->has('email'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                </div>

                <div class="form-group row {{$fast ? '' : 'fadeIn second'}}">
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                    @error('password')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>

                <div class="form-group row {{$fast ? '' : 'fadeIn third'}}">
                    <div class="form-check text-dark">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="rememberMe form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="form-group row mb-0 {{$fast ? '' : 'fadeIn fourth'}}">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <input type="submit" class="btn btn-primary" value="{{ __('Login') }}">
                    </div>
                </div>

                <div id="formFooter" class="{{$fast ? '' : 'fadeIn fifth'}}">
                    @if (Route::has('password.request'))
                    <a class="btn btn-link underline-hover forgotPass" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}

                    </a>
                    @endif
                </div>
            </form>

        </div>
    </div>
</div>

@endsection