<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        // Other commands...
        \App\Console\Commands\UpdateScheduleStatus::class,
    ];
    
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:update-schedule-status')->everyMinute();
        $schedule->command('backup:run')->daily();
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
