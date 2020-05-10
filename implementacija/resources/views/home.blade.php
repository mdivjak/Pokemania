@extends('layouts.master')

@section('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @auth
                @if (Auth::user()->bAdmin)
                    <div class="card">
                        @include('inc.new-tournament-form')
                        @include('inc.admin-dashboard-tournaments-list')
                    </div>
                @else
                    <p>Ja sam obican LUser</p>
                @endif
            @endauth
            
        </div>
    </div>
</div>
@endsection
