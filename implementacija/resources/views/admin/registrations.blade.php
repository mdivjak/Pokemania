@extends('layouts.master')

@section('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card tournaments mt-5">
                <div class="card-header" style="padding:20px;">
                    @include('inc.new-tournament')
                </div>

                <div class="card-body" style="padding-bottom:10px;">
                    @if (count($registrations) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center">User Name</th>
                                    <th style="text-align: center">e-mail</th>
                                    <th style="text-align: center">Number of pokemons</th>
                                    <th style="text-align: center">Pokecash</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($registrations as $registration)
                                    <tr>
                                        <td>{{$registration->name}}</td>
                                        <td>{{$registration->email}}</td>
                                        <td>{{$registration->cntPokemons}}</td>
                                        <td>{{$registration->cntCash}}</td>
                                        <td>
                                            <form method='POST' action='{{ route('admin.accept', [$registration->pivot->tournament_id])}}'>
                                                @csrf
                                                <input type="hidden" name="idU" value="{{ $registration->idU }}">
                                                <button type="submit" class="btn btn-success">Accept</a>
                                            </form> 
                                        </td>
                                        <td>
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
