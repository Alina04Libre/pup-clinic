<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Notifications\AppointmentConfirmation;
use App\Notifications\RescheduleAppointment;
use App\Models\User;
use App\Models\Maintenance;
use App\Models\Attachment;
use App\Models\ConsentForm;
use App\Models\ScheduleAssignment;
use App\Notifications\DeclineAppointment;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Notifications\NurseAssigned;
use App\Notifications\DoctorAssigned;
use App\Notifications\NewAppointment;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

use TCPDF;
use Illuminate\Http\Response;

class AppointmentController extends Controller
{
    //

    public function storeConsentForm(Request $request)
    {
        try {
            // Create a new consent form record
            $consentForm = new ConsentForm();

            // Assign the form data to the model's attributes
            $consentForm->name = $request->input('name');
            $consentForm->email = $request->input('email');
            $consentForm->gender = $request->input('gender');
            $consentForm->user_type = $request->input('user_type');
            $consentForm->age = $request->input('age');
            $consentForm->guardian = $request->input('guardian');
            $consentForm->guardian_relation = $request->input('guardian_relation');
            $consentForm->phone = $request->input('phone');
            $consentForm->consent_agreement = $request->input('consent_agreement');
            // $consentForm->consent_agreement = true;
            // Save the record to the database
            $consentForm->save();
            session(['consentFormId' => $consentForm->id]);
            //  dd(session('consentFormId'));
            return redirect()->route('appointments.create');
        } catch (\Exception $e) {
            Log::error('Error storing consent form: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the form.');
        }
    }



    //     return response()->json(['availableTimes' => $availableTimes->values()->toArray()]);
    // }

    public function getAvailableTimes(Request $request)
    {
        $selectedDate = $request->input('selectedDate');

        // Fetch staff schedules and existing appointments for the selected date
        $staffSchedules = $this->getStaffSchedules($selectedDate);
        DB::enableQueryLog();
        $existingAppointments = $this->getExistingAppointments($selectedDate);
        // \Log::info(DB::getQueryLog());
        // Extract both start and end times into a flat array for staff schedule

        // Get the maintenance data
        $maintenance = Maintenance::where('title', 'Appointment Time')->first();
        $appointmentTimeList = $maintenance ? collect(json_decode($maintenance->list, true)) : collect([]);


        $fullDayTimeSlots = $appointmentTimeList->map(function ($time) use ($selectedDate) {
            return date('h:i A', strtotime("$selectedDate $time"));
        });

        // // Calculate the available times based on staff schedules and appointments
        //function ($slot) use ($existingAppointments, $staffSchedules) This is an anonymous function (closure) that defines the rejection logic for each time slot.

        // $availableTimes = $fullDayTimeSlots->reject(function ($slot) use ($existingAppointments, $staffSchedules) {
        //     $slotTime = date('H:i:s', strtotime($slot));

        //     // Count the number of staff scheduled for that slot
        //     $staffCountForSlot = collect($staffSchedules)->filter(function ($schedule) use ($slotTime) {
        //         $staffStartTime = date('H:i:s', strtotime($schedule['start_time']));
        //         $staffEndTime = date('H:i:s', strtotime($schedule['end_time']));

        //         // Check if the staff schedule overlaps with the slot
        //         return $slotTime >= $staffStartTime && $slotTime <= $staffEndTime;
        //     })->count();

        //     // Count the number of booked slots for that time
        //     $bookedSlotsCount = collect($existingAppointments)->filter(function ($appointment) use ($slotTime) {
        //         $appointmentTime = date('H:i:s', strtotime($appointment));
        //         return $slotTime == $appointmentTime;
        //     })->count();

        //     // Log information for debugging
        //     \Log::info("Slot Time: $slotTime, Staff Count for Slot: $staffCountForSlot, Booked Slots Count: $bookedSlotsCount");

        //     // Reject the slot if it's booked or there are no available staff
        //     return $bookedSlotsCount >= $staffCountForSlot || $staffCountForSlot == 0;
        // });

        $availableTimes = $fullDayTimeSlots->map(function ($slot) use ($existingAppointments, $staffSchedules) {
            $slotTime = date('H:i:s', strtotime($slot));

            // Count the number of staff scheduled for that slot
            $staffCountForSlot = collect($staffSchedules)->filter(function ($schedule) use ($slotTime) {
                $staffStartTime = date('H:i:s', strtotime($schedule['start_time']));
                $staffEndTime = date('H:i:s', strtotime($schedule['end_time']));

                // Check if the staff schedule overlaps with the slot
                return $slotTime >= $staffStartTime && $slotTime <= $staffEndTime;
            })->count();

            // Count the number of booked slots for that time
            $bookedSlotsCount = collect($existingAppointments)->filter(function ($appointment) use ($slotTime) {
                $appointmentTime = date('H:i:s', strtotime($appointment));
                return $slotTime == $appointmentTime;
            })->count();

            // Log information for debugging
            \Log::info("Slot Time: $slotTime, Staff Count for Slot: $staffCountForSlot, Booked Slots Count: $bookedSlotsCount");

            // Allow the slot if it's not fully booked or there are no staff scheduled
            if ($bookedSlotsCount < $staffCountForSlot || $staffCountForSlot == 0) {
                return $slot;
            }

            return null; // Slot is fully booked
        })->filter()->values();



        \Log::info('Available Times: ' . json_encode($availableTimes));

        return response()->json(['availableTimes' => $availableTimes->values()->toArray()]);
    }

    private function getStaffSchedules($selectedDate)
    {
        // Implement your logic to fetch staff schedules for the selected date
        // You may use the ScheduleAssignment model or your existing logic
        return \App\Models\ScheduleAssignment::where(function ($query) use ($selectedDate) {
            $query->whereDate('start_date', '<=', $selectedDate)
                ->whereDate('end_date', '>=', $selectedDate);
        })
            ->whereIn('status', ['Pending', 'On going', 'For Checkup'])
            ->get(['start_time', 'end_time'])
            ->toArray();
    }


    // private function getExistingAppointments($selectedDate)
    // {
    //     $existingAppointments = \App\Models\Appointment::whereDate('appointment_date', '=', $selectedDate)
    //         ->whereIn('status', ['Pending', 'Approved', 'For Checkup'])
    //         ->pluck('appointment_time')
    //         ->map(function ($time) use ($selectedDate) {
    //             try {
    //                 // Use Carbon for parsing date and time separately
    //                 $carbonDate = Carbon::parse($selectedDate);
    //                 $carbonTime = Carbon::parse($time);

    //                 // Format the parsed date and time
    //                 $formattedTime = $carbonDate->format('Y-m-d') . ' ' . $carbonTime->format('H:i:s');
    //                 $formattedTime = Carbon::parse($formattedTime)->format('h:i A');

    //                 return $formattedTime;
    //             } catch (\Exception $e) {
    //                 // Handle parsing error, log it, or return null
    //                 \Log::error('Error parsing time: ' . $e->getMessage());
    //                 return null;
    //             }
    //         })
    //         ->filter() // Remove null values
    //         ->toArray();

    //     \Log::info('Existing Appointments: ' . json_encode($existingAppointments));

    //     return $existingAppointments;
    // }

    private function getExistingAppointments($selectedDate)
    {
        $existingAppointments = \App\Models\Appointment::where(function ($query) use ($selectedDate) {
            $query->where(function ($subquery) {
                $subquery->whereNotNull('appointment_date')
                    ->whereNull('new_appointment_date');
            })
                ->orWhere(function ($subquery) {
                    $subquery->whereNotNull('appointment_date')
                        ->whereNotNull('new_appointment_date');
                });
        })
            ->whereIn('status', ['Pending', 'Approved', 'For Checkup'])
            ->pluck('appointment_time')
            ->map(function ($time) use ($selectedDate) {
                try {
                    // Use Carbon for parsing date and time separately
                    $carbonDate = Carbon::parse($selectedDate);
                    $carbonTime = Carbon::parse($time);

                    // Format the parsed date and time
                    $formattedTime = $carbonDate->format('Y-m-d') . ' ' . $carbonTime->format('H:i:s');
                    $formattedTime = Carbon::parse($formattedTime)->format('h:i A');

                    return $formattedTime;
                } catch (\Exception $e) {
                    // Handle parsing error, log it, or return null
                    \Log::error('Error parsing time: ' . $e->getMessage());
                    return null;
                }
            })
            ->filter() // Remove null values
            ->toArray();

        \Log::info('Existing Appointments: ' . json_encode($existingAppointments));

        return $existingAppointments;
    }


    //View the Appointment Page
    public function create()
    {
        $user = Auth::user();
        $consentFormId = session('consentFormId'); // Retrieve the consentForm from the session
        $maintenance = Maintenance::where('title', 'Appointment Time')->first();

        if (!$consentFormId) {
            // Handle the case where the consent form ID is missing
            return redirect()->route('consent.create')->with('error', 'Please complete the consent form first.');
        }
        return view('forms.appointment', compact('user', 'consentFormId', 'maintenance'));
    }


    // //Function to store the Appointment
    public function store(Request $request)
    {
        // dd($request->all());
        $consentFormId = session('consentFormId');
        $appointment_time = date('H:i', strtotime($request->input('appointment_time')));
        // dd($consentFormId);

        if ($appointment_time === false) {
            // Handle invalid time format
            return redirect()->back()->with('error', 'Invalid time format.');
        }
        // Validate the appointment form data
        $validatedData = $request->validate([
            'concern' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'attachments.*' => 'mimes:pdf,doc,docx,xls,xlsx,jpeg,png|max:3072',
            // 'remark' => 'required',
            // Add validation rules for other fields
        ]);

        try {
            if (!$consentFormId) {
                // Handle the case where the consent form ID is missing
                throw new \Exception('Consent form ID is missing.');
            }

            // Create a new appointment record
            $user = Auth::user();
            $uniqueId = 'APPT-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $appointment = new Appointment([
                'user_id' => $user->id,
                'consent_id' => $consentFormId, // Associate appointment with consent form
                'name' => $user->name . ' ' . $user->middle_name . ' ' . $user->last_name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'concern' => $validatedData['concern'],
                'appointment_date' => $validatedData['appointment_date'],
                'appointment_time' => $validatedData['appointment_time'],
                // 'remark' => $validatedData['remark'],
                'unique_id' => $uniqueId,
            ]);
            // dd($appointment);
            $appointment->save();
            $appointmentId = $appointment->id;

            // Handle file uploads
            if ($request->hasFile('attachments')) {
                $totalSize = 0;

                foreach ($request->file('attachments') as $attachment) {
                    $totalSize += $attachment->getSize();
                }

                if ($totalSize > 3 * 1024 * 1024) {
                    // Total size exceeds the limit
                    return redirect()->back()->with('error', 'Total file size exceeds the limit of 3MB.');

                } else {
                    foreach ($request->file('attachments') as $attachment) {
                        $filename = $attachment->getClientOriginalName();
                        $path = $attachment->store('appointments_attachment', 'public');
                        $pathAfterPublic = str_replace('public/', '', $path); // Adjust the path as needed

                        // Create attachment record
                        $attachmentRecord = new Attachment([
                            'filename' => $filename,
                            'path' => $pathAfterPublic,
                            'mime_type' => $attachment->getClientMimeType(),
                            'size' => $attachment->getSize(),
                            'appointment_id' => $appointmentId,
                        ]);

                        $attachmentRecord->save();

                        // Attach the attachment to the appointment
                        $appointment->attachments()->attach($attachmentRecord->id);
                    }
                }
            }


            $consentForm = ConsentForm::find($consentFormId);
            $consentForm->setAppointmentId($appointment->id);
            $consentForm->setAppointmentDate($validatedData['appointment_date']);
            $consentForm->save();
            session()->forget('consentFormId');

            Queue::push(function ($job) use ($appointment) {
                $superadmins = User::role('superadmin')->get();

                foreach ($superadmins as $superadmin) {
                    $superadmin->notify(new NewAppointment($appointment));
                }

                $job->delete();
            });

            // Redirect to a success page or show a success message
            Alert::success('Success', 'Appointment made successfully');
            return redirect('/userdashboard')->with('success', 'Appointment and Consent Form saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Handle any exceptions that may occur during the save process
            Alert::error('Error', 'Failed Making Appointment!');
            Log::error('Error storing appointment: ' . $e->getMessage());
        }
    }

    public function declineAppointment($id, Request $request)
    {
        // Find the appointment by ID
        $appointment = Appointment::find($id);
        $user = $appointment->user;

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found.');
        }
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Update the appointment status and reason for declining
        $appointment->status = 'Declined';
        $appointment->reason_for_declining = $request->input('reason_for_declining');
        $appointment->save();

        // Queue the notification
        Queue::push(function ($job) use ($user, $appointment) {
            $user->notify(new DeclineAppointment($appointment, $user));
            $job->delete();
        });
        Alert::success('Success', 'Declined successfully!');
        return redirect()->back()->with('success', 'Appointment declined successfully.');
    }

    public function reschedule($id, Request $request)
    {
        // Find the appointment by ID
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found.');
        }

        // Update the appointment status to 'Re-scheduled'
        $appointment->status = 'Re-Scheduled';

        // Retrieve the new date, new time, and reason for re-scheduling
        $newDate = $request->input('new_appointment_date');
        $newTime = $request->input('new_appointment_time');
        $reason = $request->input('reason_for_resched');

        // Update the appointment record in the database with the new date and time
        $appointment->new_appointment_date = $newDate;
        $appointment->new_appointment_time = $newTime;
        $appointment->reason_for_resched = $reason; // Store the reason for re-scheduling

        // Save the changes to the appointment
        $appointment->save();
        Alert::success('Success', 'Re-Scheduled Successfully!');
        // Redirect back to the appointments page with a success message
        return redirect()->back()->with('success', 'Appointment re-scheduled successfully.');
    }

    //Original
    public function getAvailableNurse($appointmentDate, $appointmentTime)
    {
        if (!strtotime($appointmentDate) || !strtotime($appointmentTime)) {
            // Handle the case where the date or time is invalid
            return response()->json(['error' => 'Invalid date or time'], 400); // Respond with an error
        }

        // Assuming 'nurse' is the name of the role for nurses
        $nurseRole = Role::where('name', 'nurse')->first();

        if (!$nurseRole) {
            // Handle the case where the 'nurse' role doesn't exist
            return response()->json([]);
        }

        // $nurses = $nurseRole->users()
        //     ->whereHas('nurseAssignment', function ($query) use ($appointmentDate, $appointmentTime) {
        //         $query->where('start_date', '<=', $appointmentDate)
        //             ->where('end_date', '>=', $appointmentDate)
        //             ->where('start_time', '<=', $appointmentTime)
        //             ->where('end_time', '>=', $appointmentTime);
        //     })
        //     ->get();

        // // Get a list of nurse IDs already assigned to overlapping appointments for the same date and time
        $assignedNurseIds = ScheduleAssignment::where(function ($query) use ($appointmentDate, $appointmentTime) {
            $query->where('start_date', '<=', $appointmentDate)
                ->where('end_date', '>=', $appointmentDate)
                ->where(function ($q) use ($appointmentTime) {
                    $q->where('start_time', '<', $appointmentTime)
                        ->orWhere('end_time', '>', $appointmentTime);
                })
                ->whereIn('status', ['Pending', 'On going']);
        })->pluck('nurse_id')->toArray();

        // Get the IDs of appointments with the same date and time and status 'approved'
        // $appointmentIds = Appointment::where('appointment_date', $appointmentDate)
        //     ->where('appointment_time', $appointmentTime)
        //     ->whereIn('status', ['Approved', 'For Checkup'])
        //     ->pluck('nurse_id')
        //     ->toArray();

        $appointmentIds = Appointment::where(function ($query) use ($appointmentDate, $appointmentTime) {
            $query->where(function ($subquery) use ($appointmentDate, $appointmentTime) {
                $subquery->whereNotNull('new_appointment_time')
                    ->whereNotNull('new_appointment_date')
                    ->where('new_appointment_date', '=', $appointmentDate)
                    ->where('new_appointment_time', '=', $appointmentTime);
            })->orWhere(function ($subquery) use ($appointmentDate, $appointmentTime) {
                $subquery->whereNull('new_appointment_time')
                    ->whereNotNull('appointment_time')
                    ->where('appointment_date', '=', $appointmentDate)
                    ->where('appointment_time', '=', $appointmentTime);
            });
        })
        ->whereIn('status', ['Approved', 'For Checkup'])
        ->pluck('nurse_id')
        ->toArray();




        // Retrieve nurses who are already assigned to overlapping appointments
        $nurses = $nurseRole->users()
            ->whereHas('nurseAssignment', function ($query) use ($appointmentDate, $appointmentTime) {
                $query->where('start_date', '<=', $appointmentDate)
                    ->where('end_date', '>=', $appointmentDate)
                    ->where('start_time', '<=', $appointmentTime)
                    ->where('end_time', '>=', $appointmentTime);
            })
            ->whereNotIn('id', $appointmentIds)
            ->get();

        return response()->json($nurses);
    }


    public function getAvailableDoctor($appointmentDate)
    {
        $appointmentDate = date('Y-m-d', strtotime($appointmentDate));

        // Fetch the nurse ID from the appointment for the currently logged-in nurse
        $nurseId = Auth::user()->id;

        // Fetch all doctors who are assigned to the same nurse for the given appointment date
        $partnerDoctors = ScheduleAssignment::whereDate('start_date', '<=', $appointmentDate)
            ->whereDate('end_date', '>=', $appointmentDate)
            ->whereHas('nurse', function ($query) use ($nurseId) {
                $query->where('id', $nurseId);
            })
            ->with('doctor')
            ->get()
            ->pluck('doctor'); // Extract the doctor models from the collection

        return response()->json($partnerDoctors);
    }

    public function reGetAvailableDoctor($appointmentDate)
    {
        $appointmentDate = date('Y-m-d', strtotime($appointmentDate));

        // Fetch the nurse ID from the appointment for the currently logged-in nurse
        $nurseId = Auth::user()->id;

        // Fetch all doctors who are assigned to the same nurse for the given appointment date
        $partnerDoctors = ScheduleAssignment::whereDate('start_date', '<=', $appointmentDate)
            ->whereDate('end_date', '>=', $appointmentDate)
            ->whereHas('nurse', function ($query) use ($nurseId) {
                $query->where('id', $nurseId);
            })
            ->with('doctor')
            ->get()
            ->pluck('doctor'); // Extract the doctor models from the collection

        // Fetch all doctors available for the given appointment date
        $allDoctors = ScheduleAssignment::whereDate('start_date', '<=', $appointmentDate)
            ->whereDate('end_date', '>=', $appointmentDate)
            ->with('doctor')
            ->get()
            ->pluck('doctor'); // Extract the doctor models from the collection

        // Exclude partnered doctors from the list of all doctors
        $reGetDoctor = $allDoctors->diff($partnerDoctors);

        return response()->json($reGetDoctor);
    }


    public function assignDoctor($id, Request $request)
    {

        // Find the appointment by ID
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found.');
        }

        // Retrieve the nurse ID from the request
        $doctorId = $request->input('doctor_id');

        // Check if the doctor with the provided ID exists
        $doctor = User::find($doctorId);

        if (!$doctor) {
            return redirect()->back()->with('error', 'Nurse not found.');
        }

        // Retrieve the Zoom link from your Maintenance model
        // $maintenance = Maintenance::where('title', 'Zoom Link')->first();
        // $zoomLink = $maintenance ? $maintenance->getZoomLink() : null;
        $zoomLink = Maintenance::where('title', 'Zoom Link')->first();

        // Update the appointment with the assigned nurse and status 'Approved'
        $appointment->doctor_id = $doctorId;
        $appointment->status = 'For Checkup';

        // Save the changes to the appointment
        $appointment->save();

        // Queue the notification
        Queue::push(function ($job) use ($doctor, $appointment, $zoomLink) {
            $doctor->notify(new DoctorAssigned($appointment, $zoomLink));
            $job->delete();
        });

        return redirect()->back()->with('success', 'Doctor assigned successfully.');
    }

    public function assignNurse($id, Request $request)
    {
        // Find the appointment by ID
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found.');
        }

        // Retrieve the nurse ID from the request
        $nurseId = $request->input('nurse_id');

        // Check if the nurse with the provided ID exists
        $nurse = User::find($nurseId);
        $user = $appointment->user;

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if (!$nurse) {
            return redirect()->back()->with('error', 'Nurse not found.');
        }

        // Retrieve the Zoom link from your Maintenance model
        // $maintenance = Maintenance::find(1);
        $zoomLink = Maintenance::where('title', 'Zoom Link')->first();
        // $zoomLink = $maintenance ? $maintenance->getZoomLink() : null;

        // Update the appointment with the assigned nurse and status 'Approved'
        $appointment->nurse_id = $nurseId;
        $appointment->status = 'Approved';

        // Save the changes to the appointment
        $appointment->save();

        // Queue the email notifications
        Queue::push(function ($job) use ($nurse, $user, $appointment, $zoomLink) {
            $nurse->notify(new NurseAssigned($appointment, $zoomLink));
            $user->notify(new AppointmentConfirmation($appointment, $zoomLink));
            // $user->notify(new RescheduleAppointment($appointment));
            $job->delete(); // Remove the job from the queue
        });

        return redirect()->back()->with('success', 'Nurse assigned successfully.');
    }

    public function ReassignNurse($id, Request $request)
    {
        // Find the appointment by ID
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found.');
        }

        // Retrieve the nurse ID from the request
        $nurseId = $request->input('nurse_id');

        // Check if the nurse with the provided ID exists
        $nurse = User::find($nurseId);
        $user = $appointment->user;

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if (!$nurse) {
            return redirect()->back()->with('error', 'Nurse not found.');
        }

        // Retrieve the Zoom link from your Maintenance model
        // $maintenance = Maintenance::where('title', 'Zoom Link')->first();
        // $zoomLink = $maintenance ? $maintenance->getZoomLink() : null;
        $zoomLink = Maintenance::where('title', 'Zoom Link')->first();

        // Update the appointment with the assigned nurse and status 'Approved'
        $appointment->nurse_id = $nurseId;
        $appointment->status = 'Approved';

        // Save the changes to the appointment
        $appointment->save();

        // Queue the email notifications
        Queue::push(function ($job) use ($nurse, $user, $appointment, $zoomLink) {
            $nurse->notify(new NurseAssigned($appointment, $zoomLink));
            $user->notify(new RescheduleAppointment($appointment, $zoomLink));
            $job->delete(); // Remove the job from the queue
        });
        return redirect()->back()->with('success', 'Nurse assigned successfully.');
    }

    public function fetchAvailableNurses($appointmentDate)
    {
        $appointmentDate = date('Y-m-d', strtotime($appointmentDate));

        // Assuming 'nurse' is the name of the role for nurses
        $nurseRole = Role::where('name', 'nurse')->first();

        if (!$nurseRole) {
            // Handle the case where the 'nurse' role doesn't exist
            return response()->json([]);
        }

        $nurses = $nurseRole->users()
            ->whereHas('nurseAssignment', function ($query) use ($appointmentDate) {
                $query->whereDate('start_date', '<=', $appointmentDate)
                    ->whereDate('end_date', '>=', $appointmentDate);
            })
            ->get();

        return response()->json($nurses);
    }

    public function generateAppointmentPDF($id)
    {
        try {
            // Fetch the appointment details based on the $id parameter
            $appointment = Appointment::find($id);

            if (!$appointment) {
                return response()->json(['error' => 'Appointment not found'], 404);
            }

            // Create an array of appointment details
            $appointmentDetails = [
                'ID' => $appointment->unique_id,
                'Name' => $appointment->name,
                'Email' => $appointment->email,
                'Phone Number' => $appointment->phone_number,
                'Concern' => $appointment->concern,
                'Remarks' => $appointment->remark,
                'Appointment Date' => $appointment->appointment_date,
                'Appointment Time' => $appointment->appointment_time,
                'Status' => $appointment->status,
                'Reason For Decline' => $appointment->reason_for_declining,
                'Reason For Reschedule' => $appointment->reason_for_resched,
                'New Appointment Date' => $appointment->new_appointment_date,
                'New Appointment Time' => $appointment->new_appointment_time,
                // Add more appointment details as needed
            ];

            // Initialize TCPDF
            $pdf = new TCPDF();
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(false);
            $pdf->AddPage();

            // HTML content for the PDF
            $html = view('pdf.appointment_history', compact('appointmentDetails'))->render();

            // Generate and download the PDF
            $pdf->writeHTML($html);

            // Modify the file name to remove "pdfs_" and keep the ".pdf" extension
            $customFileName = str_replace('pdfs_', '', str_replace(' ', '_', $appointment->name)) . '_Appointment_Details.pdf';
            $pdfPath = 'pdfs/appointment/' . $customFileName;



            // Save the PDF to the defined path
            $pdf->Output(public_path($pdfPath), 'F');

            // Generate the download URL based on the saved PDF path
            $downloadUrl = asset($pdfPath);

            return response()->json(['download_url' => $downloadUrl, 'file_name' => $customFileName]);
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error generating PDF: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while generating the PDF'], 500);
        }
    }
}
