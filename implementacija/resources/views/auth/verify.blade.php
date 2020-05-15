@extends('layouts.master')

@section('title')
Please Verify Your Email
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
            <div class="card loginForm" style="height: 300px; width: 300px; color: red;">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
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