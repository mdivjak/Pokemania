<?php
/**
 * View za registraciju korisnika
 *
 * @author Natalija Mitić 0085/17
 *
 * @version 1.0
 */
?>

@extends('layouts.master')

@section('title')
Register
@endsection


@section('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/registration.js') }}" defer></script>
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
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Username">

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

                <div class="form-group row {{$fast ? '' : 'fadeIn fifth'}}">
                    <input type="hidden" name="avatar" value="1" id="avatar-choice">
                    <input type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#avatar-picker" value="Choose Your Avatar">
                </div>

                <div class="form-group row mb-0 {{$fast ? '' : 'fadeIn sixth'}}">
                    <input type="submit" class="btn btn-primary" value=" {{ __('Register') }}">

                </div>
                <br>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="avatar-picker" tabindex="-1" role="dialog" aria-labelledby="#avatar-picker-label" style="color:#777;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="avatar-picker-label">Select Your Avatar</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        @for ($i = 1; $i <= 9; $i++)
                            <div class="col-xs-4" style="margin-top:10px;">
                                <img src="{{ asset('images/avatars/avatar'.$i.'.png') }}" class="img-fluid img-thumbnail" id="avatar{{$i}}" onclick="pickedAvatar(this)">
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection