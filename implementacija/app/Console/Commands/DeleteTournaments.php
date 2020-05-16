<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\AdminController;

class DeleteTournaments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tournament:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete past tournaments';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now()->toDateString();
            
        $tournaments = DB::table('tournaments')->where("endDate", "<",  "$now")->get();
        foreach ($tournaments as $tournament) {
            AdminController::sendMail($tournament);
            DB::table('registered')->where('tournament_id', $tournament->id)->delete();
            DB::table('participates')->where('tournament_id', $tournament->id)->delete();
        }

        DB::table('tournaments')->where("endDate", "<",  "$now")->delete();
    }
}
