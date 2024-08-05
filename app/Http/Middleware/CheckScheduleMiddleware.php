<?php

namespace App\Http\Middleware;

use Alert;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Carbon\Carbon;

class CheckScheduleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        $user = User::with('doctorSchedule')->find($request->user()->id);

        if ($user->hasRole('doctor') || $user->hasRole('nurse')) {
            $today = Carbon::today();
            $scheduleAssignment = $user->doctorSchedule()
                ->orWhere(function ($query) use ($user) {
                    $query->where('nurse_id', $user->id);
                })
                ->whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today)
                ->get();

            // Check if there is any valid schedule for today
            if ($scheduleAssignment->where('status', '!=', 'Done')->count() > 0) {
                return $next($request);
            } else {
                Alert::info('Information', 'You have no valid Walk-In schedule for today!');
                return redirect()->route($user->hasRole('doctor') ? 'doctorCheckupAppointments' : 'nurse_checkups');
            }
        }
    }

    //     public function handle(Request $request, Closure $next): Response
    //     {

    //         $user = User::with('doctorSchedule')->find($request->user()->id);

    //         if ($user->hasRole('doctor') || $user->hasRole('nurse')) {
    //             $today = Carbon::today();
    //             $scheduleAssignment = $user->doctorSchedule()
    //                 ->orWhere(function ($query) use ($user) {
    //                     $query->where('nurse_id', $user->id);
    //                 })
    //                 ->whereDate('start_date', '<=', $today)
    //                 ->whereDate('end_date', '>=', $today)
    //                 ->get();

    //             // Check if there is a valid schedule assignment within the allowed time range
    //             $hasValidSchedule = $scheduleAssignment->first(function ($assignment) {
    //                 return $this->isCurrentTimeWithinAssignment($assignment);
    //             });

    //             if ($hasValidSchedule) {
    //                 // dd('Middleware logic reached');
    //                 return $next($request);
    //             } else {
    //                 Alert::info('Information', 'You have no valid Walk-In schedule for today!');
    //                 return redirect()->route($user->hasRole('doctor') ? 'doctorCheckupAppointments' : 'nurse_checkups');
    //             }
    //         }
    //     }
    //     protected function isCurrentTimeWithinAssignment($assignment)
    //     {
    //         $currentTime = Carbon::now();
    //         $startTime = Carbon::parse($assignment['start_date'] . ' ' . $assignment['start_time']);
    //         $endTime = Carbon::parse($assignment['end_date'] . ' ' . $assignment['end_time']);

    //         // Adjust the valid time range for checkup
    //         $validStartTime = Carbon::parse($assignment['start_date'] . ' 15:00:00');
    //         $validEndTime = Carbon::parse($assignment['end_date'] . ' 17:00:00');

    //         return $currentTime->between($validStartTime, $validEndTime) && $currentTime->between($startTime, $endTime);
    //     }
}
