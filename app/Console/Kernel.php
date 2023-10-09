<?php

namespace App\Console;

use Dymantic\InstagramFeed\Profile;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // refresh the feed for the library (this would be used in prod in a working queue every day for example)
        $schedule->call(function () {
            Profile::for('dorian')->refreshFeed();
        });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
