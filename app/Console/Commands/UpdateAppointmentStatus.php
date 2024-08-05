<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Illuminate\Console\Command;

class UpdateAppointmentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:update-status';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update appointment statuses';

    /**
     * Execute the console command.
     */
    // Update status for pending appointments based on dynamic conditions
    // app/Console/Commands/UpdateAppointmentStatus.php

    public function handle()
    {
        $pendingAppointments = Appointment::whereIn('status', ['Pending', 'Re-Scheduled', 'Approved', 'For Checkup'])
            ->where(function ($query) {
                $query->where(function ($nullIdQuery) {
                    $nullIdQuery->whereNull('nurse_id')
                        ->orWhereNull('doctor_id');
                })->orWhere(function ($innerQuery) {
                    $innerQuery->where(function ($dateQuery) {
                        $dateQuery->where(function ($originalAppointmentQuery) {
                            $originalAppointmentQuery->whereNull('reason_for_resched')
                                ->where('appointment_date', '<', now()->toDateString());
                        })->orWhere(function ($rescheduledQuery) {
                            $rescheduledQuery->whereNotNull('reason_for_resched')
                                ->where('new_appointment_date', '<', now()->toDateString());
                        });
                    })->orWhere(function ($timeQuery) {
                        $timeQuery->where(function ($originalAppointmentQuery) {
                            $originalAppointmentQuery->whereNull('reason_for_resched')
                                ->where('appointment_date', now()->toDateString())
                                ->where('appointment_time', '<', now()->format('H:i:s'));
                        })->orWhere(function ($rescheduledQuery) {
                            $rescheduledQuery->whereNotNull('reason_for_resched')
                                ->where('new_appointment_date', now()->toDateString())
                                ->where('new_appointment_time', '<', now()->format('H:i:s'));
                        });
                    });
                });
            })
            ->get();

        // Update status for fetched pending appointments using the computed attribute
        foreach ($pendingAppointments as $appointment) {
            $newStatus = $appointment->getDynamicStatus();
            $appointment->update(['status' => $newStatus]);
        }

        $this->info('Appointment statuses updated successfully!');
    }
}
