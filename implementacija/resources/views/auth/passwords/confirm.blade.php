@extends('layouts.master')

@section('title')
Confirm
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
            <div class="confirmPass">
                <p>
                    {{ __('Please confirm your password before continuing.') }}
                </p>
            </div>

            <form class="loginForm" method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="form-group row {{$fast ? '' : 'fadeIn first'}}">
                    <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="form-group row mb-0 {{$fast ? '' : 'fadeIn fourth'}}">
                    <input type="submit" class="btn btn-primary" value="{{ __('Confirm Password') }}">

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