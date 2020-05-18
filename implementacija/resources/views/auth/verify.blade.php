<?php
/**
 * View za potvrdu mejla
 *
 * @author Natalija Mitić 0085/17
 *
 * @version 1.0
 */
?>

@extends('layouts.master')

@section('title')
Email Verification
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
            <div class="card loginForm">
                <div class="card-header colorBlue headingStyle">{{ __('Verify Your Email Address') }}</div>
                <br>
                <div class="card-body colorRed smallPadding">
                    @if (session('resent'))
                    <div class="alert alert-success styleSuccess" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif
                    <div class="subText">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        <br>
                        {{ __('If you did not receive the email') }},
                    </div>

                    <div class="row">
                        &nbsp;
                    </div>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <input type="submit" class="btn btn-link p-0 m-0 align-baseline" value="Request Another Link">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection