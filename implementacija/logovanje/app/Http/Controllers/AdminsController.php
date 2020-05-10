<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tournament;

class AdminsController extends Controller
{
    public function store(Request $request) {
        //Validiraj podatke
        $this->validate($request, [
            'tournament-name' => 'required',
            'prize-amount' => 'required|regex:/^[1-9][0-9]*$/|not_in:0',
            'min-level' => 'required|regex:/^[1-9][0-9]*$/|not_in:0|lte:max-level',
            'max-level' => 'required|regex:/^[1-9][0-9]*$/|not_in:0|gte:min-level',
            'end-date' => 'required|date_format:Y-m-d|after:today',
            'registration-price' => 'required|regex:/^[1-9][0-9]*$/|not_in:0',
        ]);

        if($request->has('createTournament')) {
            $tournament = new Tournament;
            $tournament->name = $request->input('tournament-name');
            $tournament->prize = $request->input('prize-amount');
            $tournament->minLevel = $request->input('min-level');
            $tournament->maxLevel = $request->input('max-level');
            $tournament->endDate = $request->input('end-date');
            $tournament->entryFee = $request->input('registration-price');
            $tournament->save();

            return redirect('/home')->with('message', 'Successfully created tournament '.$tournament->name.'!');
        }
        else return 'Usli smo u nepoznate vode';
    }
}
