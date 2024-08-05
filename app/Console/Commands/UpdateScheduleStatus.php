<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateScheduleStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-schedule-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $schedules = \App\Models\ScheduleAssignment::all();

        foreach ($schedules as $schedule) {
            // Calculate the status based on the current date and time
            $currentDateTime = now();
            $startDateTime = $schedule->start_date . ' ' . $schedule->start_time;
            $endDateTime = $schedule->end_date . ' ' . $schedule->end_time;

            if ($currentDateTime < $startDateTime) {
                $status = 'Pending';
            } elseif ($currentDateTime >= $startDateTime && $currentDateTime <= $endDateTime) {
                $status = 'On going';
            } else {
                $status = 'Done';
            }

            // Update the status in the database
            $schedule->update(['status' => $status]);
        }

        $this->info('Schedule statuses updated successfully.');
    }
}
