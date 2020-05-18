
<?php
/**
 * View za prikazivanje instrukcija radi povraćaja lozinke
 *
 * @author Natalija Mitić 0085/17
 *
 * @version 1.0
 */
?>

@extends('layouts.master')

@section('title')
Forgot Password
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

            @if (session('status'))
            <div class="alert alert-success styleSuccess noBottomMargin" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form class="loginForm" method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group row {{$fast ? '' : 'fadeIn first'}}">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row mb-0 {{$fast ? '' : 'fadeIn second'}}">
                    <input type="submit" class="btn btn-primary" value="{{ __('Send Password Reset Link') }}">
                </div>
            </form>
        </div>
    </div>

</div>


@endsection