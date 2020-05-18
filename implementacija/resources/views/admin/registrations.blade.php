<?php
/**
 * Prikaz svih prijava na turniru
 *
 * @author Marko Divjak 0084/2017
 *
 * @version 1.0
 */
?>
@extends('layouts.master')

@section('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('title')
Tournament Registrations View
@endsection

@section('content')

<div class="container scrollMain">
    @if(session()->has('accept-message'))
    <div class="alert alert-success">
        {{session()->get('accept-message')}}
    </div>
    @endif
    @if(session()->has('decline-message'))
    <div class="alert alert-danger">
        {{session()->get('decline-message')}}
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card tournaments mt-5">
                <div class="card-header" style="padding:20px;">
                    @include('inc.new-tournament')
                </div>

                <div class="card-body scrollable" style="padding-bottom:10px;">
                    @if (count($registrations) > 0)
                    <table class="table scrollable" width="100%">
                        <thead>
                            <tr width="100%">
                                <th width="20%" style="text-align: center">User Name</th>
                                <th width="20%" style="text-align: center">e-mail</th>
                                <th width="20%" style="text-align: center">Number of pokemons</th>
                                <th width="18%" style="text-align: center">Pokecash</th>
                                <th width="20%">&nbsp;</th>
                                <th width="2%">&nbsp;</th>
                                <th width="20%">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registrations as $registration)
                            <tr width="100%">
                                <td width="20%">{{$registration->name}}</td>
                                <td width="20%">{{$registration->email}}</td>
                                <td width="20%">{{$registration->cntPokemons}}</td>
                                <td width="18%">{{$registration->cntCash}}</td>
                                <td width="20%">
                                    <form method='POST' action='{{ route('admin.accept', [$registration->pivot->tournament_id])}}'>
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="idU" value="{{ $registration->idU }}">
                                        <button type="submit" class="btn btn-success">Accept</a>
                                    </form>
                                </td>
                                <td width="1%">&nbsp;</td>
                                <td width="20%">
                                    <form method='POST' action='{{ route('admin.decline', [$registration->pivot->tournament_id])}}'>
                                        @csrf
                                        <input type="hidden" name="idU" value="{{ $registration->idU }}">
                                        <button type="submit" class="btn btn-danger">Decline</a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div>
                        {{$registrations->links()}}
                    </div>
                    @else
                    <div class="p-5" style="min-height: 400px; padding: 100px; font-size:26;">
                        <b>Currently there are no registrations for this tournament</b>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection