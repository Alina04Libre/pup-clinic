<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkup;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Appointment;
use App\Models\User;
use App\Models\WalkInCheckup;
use App\Models\ScheduleAssignment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use TCPDF;

class CheckupController extends Controller
{
    //
    public function store(Request $request, $appointment_id)
    {
        try {
            DB::beginTransaction();

            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required',
                'prescription' => 'required',
                'disposition' => 'required',
                'diagnosis' => 'required',
                'documents' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $validatedData['appointment_id'] = $appointment_id;

            if ($request->hasFile('documents')) {
                $path = $request->file('documents')->store('prescription', 'public');
                $validatedData['documents'] = $path;
            }

            // Check if the appointment status is 'Done'
            $appointment = Appointment::find($appointment_id);
            if ($appointment && $appointment->status === 'Done') {
                // If the status is 'Done', prevent further editing
                DB::rollback();
                Alert::error('Error', 'Checkup already marked as Done. Cannot be edited.');
                return back();
            }

            // Create a new Checkup model instance and fill it with the validated data
            Checkup::create($validatedData);

            if ($appointment) {
                $appointment->update(['status' => 'Done']);
            }

            DB::commit();

            Alert::success('Success', 'Checkup saved successfully!');
            $user = auth()->user();
            if ($user->hasRole('nurse')) {
                return redirect()->route('nurse-appoint-history');
            } elseif ($user->hasRole('doctor')) {
                return redirect()->route('doctorCheckupAppointments');
            } elseif ($user->hasRole('superadmin')) {
                return redirect()->route('appoint-history');
            }
        } catch (\Exception $e) {
            // Handle the exception, log it, or return an error response as needed
            DB::rollback();
            Log::error($e);
            Alert::error('Error', 'Failed saving the checkup!');
            return back()->with('error', 'An error occurred while saving the checkup.');
        }
    }

    public function walkInStore(Request $request, $user_id)
    {
        try {

            $time = date('H:i:s', strtotime($request->input('time')));
            DB::beginTransaction();

            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required',
                'prescription' => 'required',
                'complaint' => 'required',
                'diagnosis' => 'required',
                'documents' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'date' => 'required|date',
                'time' => 'required',
            ]);

            $authenticatedUser = auth()->user();
            // Find the user based on the provided user ID
            $user = User::find($user_id);
            if (!$user) {
                // Handle the case where the user is not found
                abort(404); // You can customize this based on your application's logic
            }

            // Check if the authenticated user is a nurse
            if ($authenticatedUser->hasRole('nurse')) {
                // If the nurse is logged in, use their ID as the nurse ID
                $nurseId = $authenticatedUser->id;
                $scheduleAssignment = ScheduleAssignment::where('nurse_id', $authenticatedUser->id)
                    ->where('start_date', '<=', now())  // Adjust based on your schedule logic
                    ->where('end_date', '>=', now())    // Adjust based on your schedule logic
                    ->first();
                $doctorId = optional($scheduleAssignment)->doctor_id;
            } elseif ($authenticatedUser->hasRole('doctor')) {
                $doctorId = $authenticatedUser->id;
                // Retrieve the nurse ID from the schedule assignment
                $scheduleAssignment = ScheduleAssignment::where('doctor_id', $authenticatedUser->id)
                    ->where('start_date', '<=', now())  // Adjust based on your schedule logic
                    ->where('end_date', '>=', now())    // Adjust based on your schedule logic
                    ->first();
                $nurseId = optional($scheduleAssignment)->nurse_id;
            }

            if ($request->hasFile('documents')) {
                $path = $request->file('documents')->store('prescription', 'public');
                $validatedData['documents'] = $path;
            }

            // Create a new Checkup model instance and fill it with the validated data
            $checkup = new WalkInCheckup($validatedData);
            $checkup->doctor_id = $doctorId;
            $checkup->patient_id = $user->id;
            $checkup->nurse_id = $nurseId; // Save the nurse ID
            $checkup->time = $time;
            $checkup->save();

            // Optionally, you can update the status or perform other actions here

            DB::commit();

            Alert::success('Success', 'Checkup saved successfully!');
            $user = auth()->user();
            if ($user->hasRole('nurse')) {
                return redirect()->route('nurse-appoint-history');
            } elseif ($user->hasRole('doctor')) {
                return redirect()->route('doctorCheckupAppointments');
            } elseif ($user->hasRole('superadmin')) {
                return redirect()->route('appoint-history');
            }
        } catch (\Exception $e) {
            // Handle the exception, log it, or return an error response as needed
            DB::rollback();
            Log::error($e);
            Alert::error('Error', 'Failed saving the checkup!');
            return back()->with('error', 'An error occurred while saving the checkup.');
        }
    }

    // public function getCheckupDetails($id)
    // {
    //     Log::info('Received request for checkup ID: ' . $id);
    //     // Retrieve the checkup details based on the $id
    //     $checkup = Checkup::find($id);

    //     // Check if the checkup exists
    //     if (!$checkup) {
    //         // Handle the case where the checkup is not found
    //         return response()->json(['error' => 'Checkup not found'], 404);
    //     }

    //     // Return the checkup details as JSON response
    //     return response()->json($checkup);
    // }

    public function getCheckupDetails($id)
    {
        Log::info('Received request for checkup ID: ' . $id);

        // Retrieve the checkup details based on the $id
        $checkup = Checkup::find($id);

        // Check if the checkup exists
        if (!$checkup) {
            // Handle the case where the checkup is not found
            return response()->json(['error' => 'Checkup not found'], 404);
        }

        // Prepare the data to be sent to the view
        $data = [
            'name' => $checkup->name,
            'prescription' => $checkup->prescription,
            'documents' => $checkup->documents,
            'disposition' => $checkup->disposition,
            'diagnosis' => $checkup->diagnosis,
        ];

        // Pass the data to the view
        return response()->json($data);
    }

    public function generateCheckupPDF($appointment_id)
    {
        try {
            // Fetch the appointment with the associated user, checkup, nurse, and doctor
            $appointment = Appointment::with(['user', 'checkup', 'nurse', 'doctor'])
                ->find($appointment_id);

            // Check if the appointment is found
            if (!$appointment) {
                Log::error('Appointment not found for ID: ' . $appointment_id);
                return response()->json(['error' => 'Appointment not found'], 404);
            }

            // Create an array of medical record details
            $appointmentsDetails = [
                'Appointment ID' => $appointment->unique_id,
                'Name' => $appointment->name,
                'Email' => $appointment->user->email,
                'Concern' => $appointment->concern,
                'Appointment Date' => $appointment->appointment_date,
                'Appointment Time' => $appointment->appointment_time,
                'Concern' => $appointment->concern,
                'Phone Number' => $appointment->phone_number,
                'New Date' => $appointment->new_appointment_date,
                'New Time' => $appointment->new_appointment_time,
                'Remark' => $appointment->remark,
                'Resched Reason' => $appointment->reason_for_resched,
                'Nurse Name' => optional($appointment->nurse)->name . ' ' . optional($appointment->nurse)->last_name,
                'Doctor Name' => optional($appointment->doctor)->name . ' ' . optional($appointment->doctor)->last_name,
                // Other appointment details...

                // Checkup details
                'Checkup' => [
                    'Physician Name' => $appointment->checkup->name,
                    'Prescription' => $appointment->checkup->prescription,
                    'Complaint' => $appointment->checkup->complaint,
                    'Diagnosis' => $appointment->checkup->diagnosis,
                    'Prescription Image' => $appointment->checkup->documents,
                    // Add more checkup details as needed
                ],
            ];

            // Render the Blade view to an HTML string
            $view = view('pdf.checkup_record', compact('appointmentsDetails'));
            $html = $view->render();

            // Initialize TCPDF
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // Set document information
            $pdf->SetCreator('Your Name');
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Checkup Record PDF');
            $pdf->SetSubject('Checkup Record');
            $pdf->SetKeywords('Checkup Record, PDF');

            $pdf->AddPage();

            // Define the filename for the PDF
            $filename = str_replace(' ', '_', $appointment->user->name) . '_Checkup_Record.pdf';

            // Output the medical record details to the PDF
            $pdf->writeHTML($html, true, false, true, false, '');

            // Save or directly download the PDF
            $pdf->Output(public_path('pdfs/checkups/' . $filename), 'F');

            // Return a download response
            return response()->download(public_path('pdfs/checkups/' . $filename), $filename);
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred while generating the PDF');
            // Log the exception for debugging
            Log::error('Error generating PDF: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while generating the PDF'], 500);
        }
    }

    public function generateWalkInCheckupPDF($walkInid)
    {
        try {
            // Fetch the appointment with the associated user, checkup, nurse, and doctor
            $walkIn = WalkInCheckup::with(['user', 'nurse', 'doctor'])
                ->find($walkInid);

            // Check if the appointment is found
            if (!$walkIn) {
                Log::error('Appointment not found for ID: ' . $walkInid);
                return response()->json(['error' => 'Appointment not found'], 404);
            }

            // Create an array of medical record details
            $WalkInDetails = [
                'Name' => $walkIn->user->name . ' ' . $walkIn->user->last_name,
                'Email' => $walkIn->user->email,
                'Sex' => $walkIn->user->sex,
                'Course' => $walkIn->user->course->abbreviation ?? 'N/A',
                'Strand' => $walkIn->user->strand->abbreviation ?? 'N/A',
                'Department' => $walkIn->user->department->name ?? 'N/A',
                'Year Level' => $walkIn->user->yearLevel->name ?? 'N/A',
                'Checkup Date' => $walkIn->date,
                'Checkup Time' => $walkIn->time,
                'Complaint' => $walkIn->complaint,
                'Diagnosis' => $walkIn->diagnosis,
                'Prescription' => $walkIn->prescription,
                'Prescription Image' => $walkIn->documents ?? 'N/A',
                'Nurse Name' => optional($walkIn->nurse)->name . ' ' . optional($walkIn->nurse)->last_name ?? 'N/A',
                'Doctor Name' => optional($walkIn->doctor)->name . ' ' . optional($walkIn->doctor)->last_name ?? 'N/A',
                // Other appointment details...
            ];

            // Render the Blade view to an HTML string
            $view = view('pdf.walk_checkup', compact('WalkInDetails'));
            $html = $view->render();

            // Initialize TCPDF
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // Set document information
            $pdf->SetCreator('Your Name');
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Checkup Record PDF');
            $pdf->SetSubject('Checkup Record');
            $pdf->SetKeywords('Checkup Record, PDF');

            $pdf->AddPage();

            // Define the filename for the PDF
            $filename = str_replace(' ', '_', $walkIn->user->last_name) . '_Checkup_Record.pdf';

            // Output the medical record details to the PDF
            $pdf->writeHTML($html, true, false, true, false, '');

            // Save or directly download the PDF
            $pdf->Output(public_path('pdfs/checkups/' . $filename), 'F');

            // Return a download response
            return response()->download(public_path('pdfs/checkups/' . $filename), $filename);
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred while generating the PDF');
            // Log the exception for debugging
            Log::error('Error generating PDF: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while generating the PDF'], 500);
        }
    }

    public function generateFilteredReportsPDF(Request $request)
    {
        try {
            // Fetch filtered data based on $request
            $filteredData = $this->fetchFilteredData($request);

            // Create an array to hold all report details
            $allReports = [];

            foreach ($filteredData as $data) {
                if ($data instanceof Appointment) {
                    // Example for appointment
                    $appointmentDetails = [
                        'Appointment ID' => $data->unique_id,
                        'Name' => $data->name,
                        'Email' => $data->user->email,
                        'Concern' => $data->concern,
                        'Appointment Date' => $data->appointment_date,
                        // Add more appointment details as needed
                    ];

                    $allReports[] = [
                        'type' => 'Appointment',
                        'data' => $appointmentDetails,
                    ];
                } elseif ($data instanceof WalkInCheckup) {
                    // Example for walk-in checkup
                    $walkInDetails = [
                        'Name' => $data->user->name . ' ' . $data->user->last_name,
                        'Email' => $data->user->email,
                        'Sex' => $data->user->sex,
                        'Checkup Date' => $data->date,
                        'Complaint' => $data->complaint,
                        // Add more walk-in checkup details as needed
                    ];

                    $allReports[] = [
                        'type' => 'Walk-In Checkup',
                        'data' => $walkInDetails,
                    ];
                }
            }
            // Render the Blade view to an HTML string
            $view = view('pdf.filtered_reports', compact('allReports'));
            $html = $view->render();

            // Initialize TCPDF
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // Set document information
            $pdf->SetCreator('Your Name');
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Filtered Reports PDF');
            $pdf->SetSubject('Filtered Reports');
            $pdf->SetKeywords('Filtered Reports, PDF');

            $pdf->AddPage();

            // Define the filename for the PDF
            $filename = 'Filtered_Reports.pdf';

            // Output the filtered reports to the PDF
            $pdf->writeHTML($html, true, false, true, false, '');

            // Save or directly download the PDF
            $pdf->Output(public_path('pdfs/filtered_reports/' . $filename), 'F');

            // Return a download response
            return response()->download(public_path('pdfs/filtered_reports/' . $filename), $filename);
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred while generating the PDF');
            // Log the exception for debugging
            Log::error('Error generating PDF: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while generating the PDF'], 500);
        }
    }

    private function fetchFilteredData(Request $request)
    {
        $courseCheckupFilter = $request->input('courseCheckupFilter');
        $departmentCheckupFilter = $request->input('departmentCheckupFilter');
        $strandCheckupFilter = $request->input('strandCheckupFilter');
        $statusCheckupFilter = $request->input('statusCheckupFilter');
        $ageCheckupFilter = $request->input('ageCheckupFilter');
        $nurseFilter = $request->input('nurseFilter');
        $doctorFilter = $request->input('doctorFilter');

        // Use these variables to construct your query and fetch filtered data
        $filteredData = DB::table('your_table')
            ->where('course', $courseCheckupFilter)
            ->where('department', $departmentCheckupFilter)
            ->where('strand', $strandCheckupFilter)
            ->where('status', $statusCheckupFilter)
            ->where('age', $ageCheckupFilter)
            ->where('nurseFilter', $nurseFilter)
            ->where('doctorFilter', $doctorFilter)
            // Add more conditions as needed
            ->get();

        return $filteredData;
    }
}
