<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Tournament;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $now = Carbon::now()->toDateString();
            $tournaments = DB::table('tournaments')->where("endDate", "<",  "$now")->get();
            foreach ($tournaments as $tournament) {
                DB::table('registered')->where('tournament_id', $tournament->id)->delete();
                DB::table('participates')->where('tournament_id', $tournament->id)->delete();
            }
            DB::table('tournaments')->where("endDate", "<",  "$now")->delete();
        })->daily()->at('18:12'); 

        //moze ->everyMinute();  u cmd pokrenuti php artisan schedule:run za manuelno
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
