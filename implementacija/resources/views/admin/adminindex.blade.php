@extends('layouts.master')

@section('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
@if(session()->has('tournament-exists'))
    <div class="alert alert-danger">
        {{session()->get('tournament-exists')}}
    </div>
@endif
@if(session()->has('tournament-created'))
    <div class="alert alert-success">
        {{session()->get('tournament-created')}}
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
                    @if (count($tournaments) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Tournament Name</th>
                                    <th style="text-align: center">Number of Registrations</th>
                                    <th style="text-align: center">End Date</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tournaments as $tournament)
                                    @if ($tournament->registrations_count > 0)
                                        <tr>
                                            <td>{{$tournament->name}}</td>
                                            <td>{{ $tournament->registrations_count }}</td>
                                            <td>{{$tournament->endDate}}</td>
                                            <td>
                                                <a href="{{ route('admin.registrations', [$tournament->id]) }}" class="float-right btn btn-primary">Check Pending Registrations</a>
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-danger">Delete Tournament</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div>
                            {{$tournaments->links()}}
                        </div>
                    @else
                        <div class="p-5" style="min-height: 400px; padding: 100px; font-size:26;">
                            <b style="">Currently there are no tournaments</b>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
