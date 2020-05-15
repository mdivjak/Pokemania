<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Tournament;
use App\Participates;
use App\User;
use App\Mail\AcceptRegistration;
use App\Mail\DeclineRegistration;
use App\Mail\TournamentDeleted;
use \Auth;
use \DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
        
        $this->validate($request, [
            'tournament-name' => 'required',
            'prize-amount' => 'required|regex:/^[1-9][0-9]*$/|not_in:0',
            'min-level' => 'required|regex:/^[1-9][0-9]*$/|not_in:0|lte:max-level',
            'max-level' => 'required|regex:/^[1-9][0-9]*$/|not_in:0|gte:min-level',
            'end-date' => 'required|date_format:Y-m-d|after:today',
            'registration-price' => 'required|regex:/^[1-9][0-9]*$/|not_in:0',
        ]);
        
        $tname = $request->input('tournament-name');
        $tournament = DB::table('tournaments')->where('name', $tname)->get();
        if($tournament->count() > 0) {
            return redirect()->back()->with('tournament-exists', 'Tournament with name "'.$tname.'" already exists!');
        }
        if($request->has('createTournament')) {
            $tournament = new Tournament;
            $tournament->name = $request->input('tournament-name');
            $tournament->prize = $request->input('prize-amount');
            $tournament->minLevel = $request->input('min-level');
            $tournament->maxLevel = $request->input('max-level');
            $tournament->endDate = $request->input('end-date');
            $tournament->entryFee = $request->input('registration-price');
            $tournament->save();

            return redirect()->back()->with('tournament-created', 'Successfully created tournament "'.$tournament->name.'"!');
        }
        else return 'Usli smo u nepoznate vode';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!auth()->user()->bAdmin)
            return redirect()->route('user.show', [auth()->user()->name]);

        $tournaments = Tournament::withCount('registrations')->orderBy('registrations_count', 'desc')->orderBy('endDate', 'asc')->paginate(10);
        return view('admin.adminindex')->with('tournaments', $tournaments);
    }

    public function listRegistrations(Request $request) {
        $registrations = Tournament::find($request->id)->registeredUsers()->paginate(10);
        return view('admin.registrations')->with('registrations', $registrations);
    }

    public function accept(Request $request) {
        if(!auth()->user()->bAdmin)
            return redirect()->route('user.show', [auth()->user()->name]);
        
        $registration = \DB::table('registered')->where('user_id', $request->input('idU'))->where('tournament_id', $request->id)->first();
        
        if($registration == null)
            return redirect()->route('user.show', [auth()->user()->name]);

        DB::beginTransaction();
        try {
            DB::table('participates')->insert(
                ['user_id' => $registration->user_id, 'tournament_id' => $registration->tournament_id, 'cntWin' => 0]
            );
    
            DB::table('registered')->where([
                ['user_id', $registration->user_id],
                ['tournament_id', $registration->tournament_id],
            ])->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw 'Failed transaction';
        }

        //slanje obavestenja mejlom
        $user = User::find($registration->user_id);
        $tournament = Tournament::find($registration->tournament_id);
        Mail::to($user->email)->send(new AcceptRegistration($user, $tournament));

        return redirect()->back()->with('accept-message', 'Participant successfully registered for tournament');
    }

    public function decline(Request $request) {
        if(!auth()->user()->bAdmin)
            return redirect()->route('user.show', [auth()->user()->name]);
        
        $registration = \DB::table('registered')->where('user_id', $request->input('idU'))->where('tournament_id', $request->id)->first();

        if($registration == null)
            return redirect()->route('user.show', [auth()->user()->name]);

        $tournament = Tournament::find($registration->tournament_id);
        $user = User::find($registration->user_id);
        $user->cntCash += $tournament->entryFee;
        $user->save();

        DB::table('registered')->where([
            ['user_id', $registration->user_id],
            ['tournament_id', $registration->tournament_id],
        ])->delete();

        //slanje obavestenja mejlom
        $user = User::find($registration->user_id);
        $tournament = Tournament::find($registration->tournament_id);
        Mail::to($user->email)->send(new DeclineRegistration($user, $tournament));
        
        return redirect()->back()->with('decline-message', 'Registration declined');
    }

    public function deleteTournament(Tournament $tournament) {
        $participants = $tournament->allParticipants;

        $first_message = 'You won the first place!';
        $second_message = 'You won the second place!';
        $third_message = 'You won the third place!';
        $won_prize = ' You won the first prize of '.$tournament->prize.'₽!';

        foreach($participants as $index => $participant) {
            if ($index == 0) {
                $message = $first_message;
                $cntWin = DB::table('participates')->where([['user_id', $participant->idU], ['tournament_id', $tournament->id]])->first()->cntWin;
                if ($cntWin > 0) {
                    $message = $won_prize;
                    $participant->cntCash += $tournament->prize;
                    $participant->save();
                }
            }
            else if ($index == 1) $message = $second_message;
            else if ($index == 2) $message = $third_message;
            else $message = 'You are '. $index + 1 .'. on the list of all participants!';

            Mail::to($participant->email)->send(new TournamentDeleted($participant, $tournament, $message));
        }

        DB::table('registered')->where('tournament_id', $tournament->id)->delete();
        DB::table('participates')->where('tournament_id', $tournament->id)->delete();
        $tournament->delete();
        return redirect()->back()->with('tournament-created', 'Successfully deleted tournament "'.$tournament->name.'"!');
    }
}
