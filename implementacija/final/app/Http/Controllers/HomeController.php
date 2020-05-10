<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use App\Tournament;

class HomeController extends Controller
{
    //----------------------LOGOVANJE - MARKOVO-------------------------
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->bAdmin) {
            $tournaments = Tournament::orderBy('endDate', 'asc')->paginate(2);
            return view('home')->with('tournaments', $tournaments);
        }
        return view('home');
    }

    //-------------------KRAJ MARKOVOG--------------------------
}
