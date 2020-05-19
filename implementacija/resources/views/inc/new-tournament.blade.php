<?php

/**
 * Dugme i modalni dijalog sa formom za kreiranje novog turnira
 *
 * @author Marko Divjak 0084/2017
 *
 * @version 1.0
 */
?>
<div class="row">
  <div class="col-sm-4 float-left">
    @if (Route::current()->getName() == 'admin.registrations')
    <a id="backButton" href="{{ route('admin') }}" class="btn btn-default float-left" style="float:left;">
      <i class="fas fa-arrow-left"></i>
    </a>
    @endif
  </div>
  <div class="col-sm-4">
    <p>
      <b>
        @if (Route::current()->getName() == 'admin.registrations')
        <a class="tour-name" href="{{ route('tournament.show', [$tournament->id]) }}">{{$tournament->name}}</a></td>
        @else
        Tournament Maintenance
        @endif

      </b>
    </p>
  </div>
  <div class="col-sm-4 alignRight">
    @if (Route::current()->getName() != 'admin.registrations')
    <a href="" class="btn btn-success float-right new-tournament-button" data-toggle="modal" data-target="#newTournamentForm" data-whatever="@mdo">
      <!-- <i class="fas fa-plus"></i> -->
      <img src="{{URL::to('images/newT.svg')}}" alt="">
    </a>
    @endif
  </div>
</div>
<div class="modal fade" id="newTournamentForm" tabindex="-1" role="dialog" aria-labelledby="newTournamentFormTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="#newTournamentFormTitle">Create New Tournament</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['action' => 'AdminController@store', 'method' => 'POST']) !!}
      <div class="modal-body" style="min-height: 400px;">
        <div class="form-group">
          <label for="tournament-name" class="col-form-label">Tournament Name:</label>
          <input type="text" class="form-control" id="tournament-name" name="tournament-name">
        </div>
        <div class="form-group">
          <label for="registration-price" class="col-form-label">Registration Price:</label>
          <input type="number" id="registration-price" class="form-control" name="registration-price" min="0">
        </div>
        <div class="form-group">
          <label for="end-date" class="col-form-label">End Date:</label>
          <input type="date" id="end-date" class="form-control" name="end-date" min="<?php echo date("Y-m-d"); ?>">
        </div>
        <div class="form-group">
          <label for="prize-amount" class="col-form-label">Prize Amount:</label>
          <input type="number" id="prize-amount" class="form-control" name="prize-amount" min="0">
        </div>
        <div class="form-row">
          <div class="col-md-6 goLeft">
            <label for="min-level" class="col-form-label">Min Level:</label>
            <input type="number" id="min-level" class="form-control" name="min-level" min="1" max="100">
          </div>
          <div class="col-md-6 goRight">
            <label for="max-level" class="col-form-label">Max Level:</label>
            <input type="number" id="max-level" class="form-control" name="max-level" min="1" max="100">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{Form::submit('Create tournament', ['class' => 'btn btn-primary', 'name' => 'createTournament'])}}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>