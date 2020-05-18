<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\AdminController;
use App\Mail\AcceptRegistration;
use Illuminate\Support\Facades\Mail;
use App\Mail\TournamentDeleted;
use App\User;
use App\Tournament;
use Illuminate\Support\Facades\URL;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DeleteTournaments::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        
        $schedule->command('tournament:delete')->dailyAt('13:13')->sendOutputTo('deleteTournament.log');

        //u cmd pokrenuti php artisan schedule:run za manuelno
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
