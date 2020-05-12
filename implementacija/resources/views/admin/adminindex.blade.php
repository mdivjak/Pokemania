@extends('layouts.master')

@section('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card tournaments mt-5">
                <div class="card-header" style="padding:20px;">
                    @include('inc.new-tournament')
                </div>

                <div class="card-body">
                    @if (count($tournaments) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Tournament Name</th>
                                    <th style="text-align: center">End Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tournaments as $tournament)
                                    <tr>
                                        <td>{{$tournament->name}}</td>
                                        <td>{{$tournament->endDate}}</td>
                                        <td>
                                            <a href="{{ route('admin.registrations', [$tournament->id]) }}" class="float-right btn btn-primary">Check Pending Registrations</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div>
                            {{$tournaments->links()}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
