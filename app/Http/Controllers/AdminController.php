<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Announcement;
use App\Models\Branch;
use App\Models\Checkup;
use App\Models\ConsentForm;
use App\Models\Faq;
use App\Models\Satellite;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use  App\Models\User;
use App\Models\MedicalRecord;
use App\Models\ScheduleAssignment;
use App\Models\UserCategory;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Maintenance;
use App\Models\WalkInCheckup;
use Symfony\Component\VarDumper\Caster\RedisCaster;
use Spatie\Permission\Models\Permission;


class AdminController extends Controller
{

    protected $count;
    //
    public function dashboard()
    {
        $usersWithRegularUserRoleCount = User::role('regular_user')->count();

        $approvedAppointmentsCount = Appointment::whereIn('status', ['Approved', 'For Checkup', 'Done'])->count();
        $pendingAppointmentsCount = Appointment::where('status', 'Pending')->count();
        $declinedAppointmentsCount = Appointment::where('status', 'Declined')->count();
        $reAppointmentsCount = Appointment::whereNotNull('reason_for_resched')->count();
        $doneCheckupAppointments = Appointment::where('status', 'Done')->count();

        $doneMAppointmentsCount = Appointment::where('status', 'Done')
            ->whereRaw('DAYOFWEEK(appointment_date) = 2') // 2 corresponds to Monday in MySQL
            ->count();
        $doneTAppointmentsCount = Appointment::where('status', 'Done')
            ->whereRaw('DAYOFWEEK(appointment_date) = 3') // 3 corresponds to Tuesday in MySQL
            ->count();
        $doneWAppointmentsCount = Appointment::where('status', 'Done')
            ->whereRaw('DAYOFWEEK(appointment_date) = 4') // 4 corresponds to Wed in MySQL
            ->count();
        $doneTHAppointmentsCount = Appointment::where('status', 'Done')
            ->whereRaw('DAYOFWEEK(appointment_date) = 5') // 5 corresponds to TH in MySQL
            ->count();
        $doneFAppointmentsCount = Appointment::where('status', 'Done')
            ->whereRaw('DAYOFWEEK(appointment_date) = 6') // 6 corresponds to Friday in MySQL
            ->count();
        $doneSAppointmentsCount = Appointment::where('status', 'Done')
            ->whereRaw('DAYOFWEEK(appointment_date) = 7') // 7 corresponds to Sat in MySQL
            ->count();

        $forCheckupAppointments = Appointment::with('user')
            ->where('status', 'For Checkup')
            ->get();

        return view('admin.dashboard', compact(
            'usersWithRegularUserRoleCount',
            'approvedAppointmentsCount',
            'declinedAppointmentsCount',
            'reAppointmentsCount',
            'doneMAppointmentsCount',
            'doneTAppointmentsCount',
            'doneWAppointmentsCount',
            'doneTHAppointmentsCount',
            'doneFAppointmentsCount',
            'doneSAppointmentsCount',
            'forCheckupAppointments',
            'doneCheckupAppointments',
            'pendingAppointmentsCount',
        ));
    }

    public function nurseDashboard()
    {

        $nurseId = Auth::user()->id;
        $appointments = Appointment::with('nurse', 'doctor')->get();
        $usersWithRegularUserRoleCount = User::role('regular_user')->count();
        $approvedAppointmentsCount = Appointment::whereIn('status', ['Approved', 'For Checkup', 'Done'])
            ->where('nurse_id', $nurseId)
            ->count();

        $pendingAppointmentsCount = Appointment::where('status', 'Pending')
            ->where('nurse_id', $nurseId)
            ->count();

        $declinedAppointmentsCount = Appointment::where('status', 'Declined')->count();
        $reAppointmentsCount = Appointment::whereNotNull('reason_for_resched')->count();

        $doneCheckupAppointments = Appointment::where('status', 'Done')
            ->where('nurse_id', $nurseId)
            ->count();
        // $userCategories = UserCategory::pluck('name', 'id');

        $doneMAppointmentsCount = Appointment::where('status', 'Done')
            ->where('nurse_id', $nurseId)
            ->whereRaw('DAYOFWEEK(appointment_date) = 2') // 2 corresponds to Monday in MySQL
            ->count();
        $doneTAppointmentsCount = Appointment::where('status', 'Done')
            ->where('nurse_id', $nurseId)
            ->whereRaw('DAYOFWEEK(appointment_date) = 3') // 3 corresponds to Tuesday in MySQL
            ->count();

        $doneWAppointmentsCount = Appointment::where('status', 'Done')
            ->where('nurse_id', $nurseId)
            ->whereRaw('DAYOFWEEK(appointment_date) = 4') // 4 corresponds to Wed in MySQL
            ->count();
        $doneTHAppointmentsCount = Appointment::where('status', 'Done')
            ->where('nurse_id', $nurseId)
            ->whereRaw('DAYOFWEEK(appointment_date) = 5') // 5 corresponds to TH in MySQL
            ->count();
        $doneFAppointmentsCount = Appointment::where('status', 'Done')
            ->whereRaw('DAYOFWEEK(appointment_date) = 6') // 6 corresponds to Friday in MySQL
            ->count();

        $doneSAppointmentsCount = Appointment::where('status', 'Done')
            ->where('nurse_id', $nurseId)
            ->whereRaw('DAYOFWEEK(appointment_date) = 7') // 7 corresponds to Sat in MySQL
            ->count();

        $forCheckupAppointments = Appointment::with('user')
            ->where('nurse_id', $nurseId)
            ->where('status', 'For Checkup')
            ->get();

        // Filter appointments by nurse ID and either status "For Checkup"
        $pendingAppointments = Appointment::with('user')
            ->where('nurse_id', $nurseId)
            ->where(function ($query) {
                $query->where('status', 'For Checkup')
                    ->orWhere('status', 'Done');
            })
            ->get();

        $expiredAppointments = Appointment::with('user')
            ->where('status', 'Expired')
            ->where('nurse_id', $nurseId)
            ->get();

        $expiredAppointmentsCount = $expiredAppointments->count();

        return view('admin.nurseModule.dashboard', compact(
            'usersWithRegularUserRoleCount',
            'approvedAppointmentsCount',
            'declinedAppointmentsCount',
            'reAppointmentsCount',
            'doneMAppointmentsCount',
            'doneTAppointmentsCount',
            'doneWAppointmentsCount',
            'doneTHAppointmentsCount',
            'doneFAppointmentsCount',
            'doneSAppointmentsCount',
            'forCheckupAppointments',
            'doneCheckupAppointments',
            'pendingAppointmentsCount',
            'expiredAppointmentsCount',

        ));
    }

    public function doctorDashboard()
    {

        $doctorId = Auth::user()->id;
        $appointments = Appointment::with('nurse', 'doctor')->get();
        $usersWithRegularUserRoleCount = User::role('regular_user')->count();
        $approvedAppointmentsCount = Appointment::whereIn('status', ['Approved', 'For Checkup', 'Done'])
            ->where('doctor_id', $doctorId)
            ->count();

        $pendingAppointmentsCount = Appointment::where('status', 'Pending')
            ->where('doctor_id', $doctorId)
            ->count();

        $declinedAppointmentsCount = Appointment::where('status', 'Declined')->count();
        $reAppointmentsCount = Appointment::whereNotNull('reason_for_resched')->count();

        $doneCheckupAppointments = Appointment::where('status', 'Done')
            ->where('doctor_id', $doctorId)
            ->count();
        // $userCategories = UserCategory::pluck('name', 'id');

        $doneMAppointmentsCount = Appointment::where('status', 'Done')
            ->where('doctor_id', $doctorId)
            ->whereRaw('DAYOFWEEK(appointment_date) = 2') // 2 corresponds to Monday in MySQL
            ->count();
        $doneTAppointmentsCount = Appointment::where('status', 'Done')
            ->where('doctor_id', $doctorId)
            ->whereRaw('DAYOFWEEK(appointment_date) = 3') // 3 corresponds to Tuesday in MySQL
            ->count();

        $doneWAppointmentsCount = Appointment::where('status', 'Done')
            ->where('doctor_id', $doctorId)
            ->whereRaw('DAYOFWEEK(appointment_date) = 4') // 4 corresponds to Wed in MySQL
            ->count();
        $doneTHAppointmentsCount = Appointment::where('status', 'Done')
            ->where('doctor_id', $doctorId)
            ->whereRaw('DAYOFWEEK(appointment_date) = 5') // 5 corresponds to TH in MySQL
            ->count();
        $doneFAppointmentsCount = Appointment::where('status', 'Done')
            ->whereRaw('DAYOFWEEK(appointment_date) = 6') // 6 corresponds to Friday in MySQL
            ->count();

        $doneSAppointmentsCount = Appointment::where('status', 'Done')
            ->where('doctor_id', $doctorId)
            ->whereRaw('DAYOFWEEK(appointment_date) = 7') // 7 corresponds to Sat in MySQL
            ->count();

        $forCheckupAppointments = Appointment::with('user')
            ->where('doctor_id', $doctorId)
            ->where('status', 'For Checkup')
            ->get();

        // Filter appointments by doctor ID and either status "For Checkup"
        $pendingAppointments = Appointment::with('user')
            ->where('doctor_id', $doctorId)
            ->where(function ($query) {
                $query->where('status', 'For Checkup')
                    ->orWhere('status', 'Done');
            })
            ->get();

        $expiredAppointments = Appointment::with('user')
            ->where('status', 'Expired')
            ->where('doctor_id', $doctorId)
            ->get();

        $expiredAppointmentsCount = $expiredAppointments->count();

        return view('admin.doctorModule.dashboard', compact(
            'usersWithRegularUserRoleCount',
            'approvedAppointmentsCount',
            'declinedAppointmentsCount',
            'reAppointmentsCount',
            'doneMAppointmentsCount',
            'doneTAppointmentsCount',
            'doneWAppointmentsCount',
            'doneTHAppointmentsCount',
            'doneFAppointmentsCount',
            'doneSAppointmentsCount',
            'forCheckupAppointments',
            'doneCheckupAppointments',
            'pendingAppointmentsCount',
            'expiredAppointmentsCount',

        ));
    }

    //View of faqs page
    public function faq()
    {
        $faqs = Faq::all();
        // Pass the data to the view
        return view('admin.faqs', ['faqs' => $faqs]);
    }


    public function viewFaqs(Faq $faqs)
    {
        $faqs = Faq::orderBy('created_at', 'desc')->get();
        return view('admin.allFaqs', compact('faqs'));
        // return view('faqs.show', ['faqs' => $faqs]);
    }

    public function makeFaqs()
    {
        return view('admin.makeFaqs');
    }


    public function faqStore(Request $request)
    {

        try {
            $data = $request->validate([
                'question' => 'required',
                'answer' => 'required',
            ]);



            Faq::create($data);


            Alert::success('Success', 'Faqs has been made!');
            return redirect()->route('view.faqs')->with('success', 'Faq`s created successfully');
        } catch (\Exception $e) {
            // If an exception occurs, you can handle it here
            Alert::error('Error', 'An error occurred while creating the announcement: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function editFaqs($id)
    {
        $faq = Faq::find($id);

        return view('admin.editFaqs', compact('faq'));
    }

    public function updateFaqs(Request $request, $id)
    {
        // Retrieve the faq with the given ID
        $faq = Faq::find($id);

        // Update the faq with the submitted data
        $faq->question = $request->input('question');
        $faq->answer = $request->input('answer');

        $faq->save();

        // Redirect to the faq view or any other page as needed
        Alert::success('Success', 'Faq has been updated!');
        return redirect()->route('view.faqs');
    }

    public function deleteFaqs($id)
    {
        // Find the faq by ID
        $faq = Faq::find($id);

        // Check if the faqs exists
        if (!$faq) {
            // Handle case where faqs is not found (e.g., show an error)
            return redirect()->route('view.faqs')->with('error', 'Frequently Ask Question not found.');
        }

        // Delete the faqs
        $faq->delete();
        Alert::success('Success', 'Selected Frequently Ask Question has been deleted!');
        // Redirect back to the announcements view with a success message
        return redirect()->route('view.faqs')->with('success', 'Frequently Ask Question deleted successfully.');
    }

    //view page of announcement
    public function viewAnnouncements()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        return view('admin.allAnnouncements', compact('announcements'));
    }

    public function makeAnnouncements()
    {
        return view('admin.make_announcements');
    }

    public function announcementStore(Request $request)
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'written_by' => 'required|string|max:255',
                'body' => 'required|string', // You can use 'string' for text
            ]);

            $data['is_active'] = true;

            Announcement::create($data);

            Alert::success('Success', 'Announcement has been made!');
            return redirect()->route('view.announcement')->with('success', 'Announcement created successfully');
        } catch (\Exception $e) {
            // If an exception occurs, you can handle it here
            Alert::error('Error', 'An error occurred while creating the announcement: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    //For the toggle/switch button
    public function updateStatus($announcementId)
    {
        Log::info('Toggle Active Status Request: ' . $announcementId);

        try {
            $announcement = Announcement::findOrFail($announcementId);

            // Toggle the status explicitly
            $newStatus = !$announcement->is_active;
            $status = $announcement->is_active;

            // Update the announcement with the new status
            $announcement->is_active = $newStatus;
            $announcement->save();
            // Log::info('Update Status Request', ['announcementId' => $announcementId, 'oldStatus' => $announcement->is_active, 'newStatus' => $newStatus, 'status now' => $status]);


            return response()->json(['message' => 'Status updated successfully', 'new_status' => $newStatus]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function editAnnouncements($id)
    {
        $announcement = Announcement::find($id);
        $announcement->body = $this->viewImageEditAnnouncements($announcement->body);
        return view('admin.edit_Announcements', compact('announcement'));
    }

    public function updateAnnouncement(Request $request, $id)
    {
        // Retrieve the announcement with the given ID
        $announcement = Announcement::find($id);

        // Update the announcement with the submitted data
        $announcement->title = $request->input('title');
        $announcement->written_by = $request->input('written_by');
        $announcement->body = $request->input('body');
        $announcement->save();

        // Redirect to the Announcements view or any other page as needed
        Alert::success('Success', 'Announcement has been updated!');
        return redirect()->route('view.announcement');
    }

    private function viewImageEditAnnouncements($body)
    {
        // logic to find and complete image URLs, e.g., using regular expressions

        $body = preg_replace('/<img src="\/uploads\/announcementsImage\//', '<img src="' . asset('uploads/announcementsImage/'), $body);
        return $body;
    }

    //Handles the image upload in the announcement
    public function uploadImage(Request $request)
    {
        $imgpath = request()->file('file')->store('announcementsImage', 'public');
        return response()->json(['location' => "/uploads/$imgpath"]);
    }

    public function deleteAnnouncement($id)
    {
        // Find the announcement by ID
        $announcement = Announcement::find($id);

        // Check if the announcement exists
        if (!$announcement) {
            // Handle case where announcement is not found (e.g., show an error)
            return redirect()->route('view.announcement')->with('error', 'Announcement not found.');
        }

        // Delete the announcement
        $announcement->delete();
        Alert::success('Success', 'Selected announcement has been deleted!');
        // Redirect back to the announcements view with a success message
        return redirect()->route('view.announcement')->with('success', 'Announcement deleted successfully.');
    }


    //Pending Appointments superadmin side
    public function viewPendingAppointments()
    {
        $appointments = Appointment::with('user')->get();
        $pendingAppointments = Appointment::with('user')
            ->whereIn('status', ['Pending', 'Re-Scheduled'])
            ->get();

        $doctors = ScheduleAssignment::with('doctor')->get(); // Eager load the doctor relationship
        $nurses = ScheduleAssignment::with('nurse')->get(); // Eager load the doctor relationship

        $pendingAppointmentsCount = Appointment::where('status', 'Pending')->count();
        $reAppointmentsCount = Appointment::whereNotNull('reason_for_resched')->count();
        $expiredAppointmentsCount = Appointment::where('status', 'Expired')->count();
        $appointmentTime = Maintenance::where('title', 'Appointment Time')->first();

        return view('admin.adminModule.pending_appointments', [
            'pendingAppointments' => $pendingAppointments,
            'appointments' => $appointments,
            'doctors' => $doctors,
            'nurses' => $nurses,
            'expiredAppointmentsCount' => $expiredAppointmentsCount,
            'pendingAppointmentsCount' => $pendingAppointmentsCount,
            'reAppointmentsCount' => $reAppointmentsCount,
            'appointmentTime' => $appointmentTime
        ]);
    }

    //Medical Records page
    public function medicalRecords()
    {
        $courseMaintenance = Maintenance::where('title', 'Course')->first();
        $strandMaintenance = Maintenance::where('title', 'Strand')->first();
        $departmentMaintenance = Maintenance::where('title', 'Department')->first();
        // Find the "regular_users" role
        $regularUserRole = Role::where('name', 'regular_user')->first();
        DB::enableQueryLog();
        $users = $regularUserRole->users()->orderBy('updated_at', 'desc')->get();
        Log::info(DB::getQueryLog());
        return view('admin.medical_records', compact('users', 'courseMaintenance', 'departmentMaintenance', 'strandMaintenance'));
    }

    //Each patient view of Medical Record
    public function viewMedicalRecords($patientId)
    {
        // Fetch the medical record for the user
        $medicalRecord = MedicalRecord::where('user_id', $patientId)->first();


        if (!$medicalRecord) {
            Log::info("No medical record found for patient ID: $patientId");
            Alert::info('Info', 'There is no existing medical record for this patient.');
            return redirect()->back();
        }

        $user =  $medicalRecord->user;
        $walkInCheckups = WalkInCheckup::where('patient_id', $patientId)->get();
        $appointment = Appointment::where('user_id', $user->id)->first();
        // Fetch all checkups associated with the user
        $checkups = Checkup::whereHas('appointment', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();


        return view('admin.view_medical_records', [
            'medicalRecord' => $medicalRecord,
            'user' => $user,
            'appointment' => $appointment,
            'checkups' => $checkups,
            'walkInCheckups' => $walkInCheckups
        ]);
    }

    //edit view of Medical Record page
    public function editMedicalRecords($patientId)
    {
        // Fetch the medical record for the specified user ID ($patientId), or create a new one if not found
        $medicalRecord = MedicalRecord::firstOrNew(['user_id' => $patientId]);

        return view('admin.edit_medical_records', compact('medicalRecord', 'patientId'));
    }

    //edit view of Medical Record page
    public function editMedicalRecords2($patientId)
    {
        // Fetch the medical record for the specified user ID ($patientId), or create a new one if not found
        $medicalRecord = MedicalRecord::firstOrNew(['user_id' => $patientId]);

        return view('admin.edit_medical_records_2', compact('medicalRecord', 'patientId'));
    }

    //View of Appointment History page Superadmin
    public function appointHistory()
    {
        $appointments = Appointment::with('nurse', 'doctor', 'user.course', 'user.department', 'user.strand')
            ->latest('updated_at', 'desc')
            ->get();
        $approvedAppointmentsCount = Appointment::whereIn('status', ['Approved', 'For Checkup', 'Done'])->count();
        $declinedAppointmentsCount = Appointment::where('status', 'Declined')->count();
        $reAppointmentsCount = Appointment::whereNotNull('reason_for_resched')->count();
        $forCheckupAppointments = Appointment::where('status', 'For Checkup')->count();
        $doneCheckupAppointments = Appointment::where('status', 'Done')->count();
        $expiredAppointmentsCount = Appointment::where('status', 'Expired')->count();

        $consents = ConsentForm::all();
        $userCategories = UserCategory::pluck('name', 'id');

        return view('admin.appointment_history', compact(
            'appointments',
            'consents',
            'approvedAppointmentsCount',
            'declinedAppointmentsCount',
            'reAppointmentsCount',
            'forCheckupAppointments',
            'doneCheckupAppointments',
            'expiredAppointmentsCount'
        ));
    }

    //Fetching of the appointment details for the modal
    public function getAppointmentDetails($appointmentId)
    {
        // Fetch the appointment by ID
        $appointment = Appointment::with(['nurse', 'doctor'])->find($appointmentId);
        // $appointment = Appointment::with('nurse', 'doctor')->get();
        //For Consent Form
        $consentForm = $appointment->consentForm;
        $gender = $consentForm ? $consentForm->gender : 'N/A';
        $age = $consentForm ? $consentForm->age : 'N/A';
        $userType = $consentForm ? $consentForm->user_type : 'N/A';
        $guardian = $consentForm ? $consentForm->guardian : 'N/A';
        $guardian_relation = $consentForm ? $consentForm->guardian_relation : 'N/A';
        $phone = $consentForm ? $consentForm->phone : 'N/A';

        if (!$appointment) {
            Alert::info('error', 'Appointment not found');
            return response()->json(['error' => 'Appointment not found'], 404);
        }

        $formattedCreatedAt = $appointment->created_at->format('M d, Y h:i A');
        $formattedUpdatedAt = $appointment->updated_at->format('M d, Y h:i A');
        $formattedAppointDate = $appointment->appointment_date->format('M d, Y');
        $formattedAppointTime = $appointment->appointment_time->format('h:i A');

        if (!empty($appointment->new_appointment_date) && !empty($appointment->new_appointment_time)) {
            $formattedNewAppointDate = $appointment->new_appointment_date->format('M d, Y');
            $formattedNewAppointTime = $appointment->new_appointment_time->format('h:i A');
        } else {
            // Handle the case where new appointment date or time is null
            $formattedNewAppointDate = 'N/A';
            $formattedNewAppointTime = 'N/A';
        }

        $response = [
            'name' => $appointment->name,
            'email' => $appointment->email,
            'phone_number' => $appointment->phone_number,
            'concern' => $appointment->concern,
            // 'remark' => $appointment->remark,
            'status' => $appointment->status,
            'reason_for_re_sched' => $appointment->reason_for_resched,
            'reason_for_decline' => $appointment->reason_for_declining,
            'appointment_date' => $formattedAppointDate,
            'appointment_time' => $formattedAppointTime,
            'new_appointment_date' => $formattedNewAppointDate,
            'new_appointment_time' => $formattedNewAppointTime,
            'gender' => $gender,
            'age' => $age,
            'user_type' => $userType,
            'guardian' => $guardian,
            'guardian_relation' => $guardian_relation,
            'phone' => $phone,
            'attachments' => $appointment->attachments,
            'created_at_formatted' => $formattedCreatedAt,
            'updated_at_formatted' => $formattedUpdatedAt,
            'statusTimestamp' => $appointment->created_at->format('Y-m-d h:i A', strtotime($appointment->created_at)),

        ];

        //For the Transaction Process of Superadmin
        if ($appointment->status == 'Approved' || $appointment->status == 'Re-Scheduled' || $appointment->status == 'Declined' || $appointment->status == 'Pending') {
            $response['appointmentStatus'] = $appointment->status;
            $response['status_superadmin_timestamp'] = $appointment->created_at->format('Y-m-d h:i A', strtotime($appointment->created_at));
        } elseif ($appointment->status == 'For Checkup') {
            if (!isset($response['appointmentStatus']) || $response['appointmentStatus'] == 'Approved') {
                $response['appointmentStatus'] = 'Approved';
                $response['status_superadmin_timestamp'] = $appointment->created_at->format('Y-m-d h:i A', strtotime($appointment->created_at));
            }
        } elseif ($appointment->status == 'Done') {
            if (!isset($response['appointmentStatus']) || $response['appointmentStatus'] == 'Approved') {
                $response['appointmentStatus'] = 'Approved';
                $response['status_superadmin_timestamp'] = $appointment->created_at->format('Y-m-d h:i A', strtotime($appointment->created_at));
            }
        }


        if ($appointment->nurse) {
            $response['assign_nurse'] = $appointment->nurse->name . ' ' . $appointment->nurse->last_name;
            $response['assign_nurse_timestamp'] = $appointment->created_at->format('Y-m-d h:i A', strtotime($appointment->created_at));
        }

        if ($appointment->doctor) {
            $response['checkup_doctor'] = $appointment->doctor->name . ' ' . $appointment->doctor->last_name;
            $response['checkup_timestamp'] = $appointment->updated_at->format('Y-m-d h:i A', strtotime($appointment->updated_at));
        }

        // Return the appointment details as JSON
        return response()->json($response);
    }

    //Appointment History for the nurse side
    public function nurseAppointHistory()
    {
        $nurseId = Auth::user()->id;
        $appointments = Appointment::with('nurse', 'doctor')->get();
        $consents = ConsentForm::all();
        // $userCategories = UserCategory::pluck('name', 'id');

        // Filter appointments by nurse ID and either status "For Checkup"
        $pendingAppointments = Appointment::with('user')
            ->where('nurse_id', $nurseId)
            ->where(function ($query) {
                $query->where('status', 'For Checkup')
                    ->orWhere('status', 'Done');
            })
            ->get();

        $expiredAppointments = Appointment::with('user')
            ->where('status', 'Expired')
            ->where('nurse_id', $nurseId)
            ->get();
        $expiredAppointmentsCount = $expiredAppointments->count();

        return view('admin.nurseModule.appointment_history', [
            'appointments' => $appointments,
            'consents' => $consents,
            'pendingAppointments' => $pendingAppointments,
            'expiredAppointmentsCount' =>  $expiredAppointmentsCount,
        ]);
    }

    //Appointment History for the doctor side
    public function doctorAppointHistory()
    {
        $doctorId = Auth::user()->id;
        $loggedInUserRole = auth()->user()->role;
        // Filter appointments by doctor ID and status "Done"
        $pendingAppointments = Appointment::with('user')
            ->where('doctor_id', $doctorId)
            ->where('status', 'Done')
            ->get();

        $expiredAppointments = Appointment::with('user')
            ->where('status', 'Expired')
            ->where('doctor_id', $doctorId)
            ->get();
        $expiredAppointmentsCount = $expiredAppointments->count();

        return view('admin.doctorModule.doctor_history_appoint', [
            'pendingAppointments' => $pendingAppointments,
            'loggedInUserRole' => $loggedInUserRole,
            'expiredAppointmentsCount' => $expiredAppointmentsCount
        ]);
    }

    //View of maintenance page
    public function maintenance()
    {
        $maintenances = Maintenance::all();

        // Pass the data to the view
        return view('admin.maintenance', ['maintenances' => $maintenances]);
    }

    //Page of New Medical Record
    public function newMedicalRecord()
    {
        return view('admin.new_medical_records');
    }


    public function viewDoctorCheckups()
    {
        $loggedInUserRole = auth()->user()->role;
        $appointments = Appointment::with('user')->get();
        $pendingAppointments = Appointment::with('user')
            ->where('status', 'For Checkup')
            ->get();
        $doctors = ScheduleAssignment::with('doctor')->get(); // Eager load the doctor relationship
        $nurses = ScheduleAssignment::with('nurse')->get(); // Eager load the doctor relationship
        return view('admin.doctorModule.doctor_checkups', [
            'pendingAppointments' => $pendingAppointments,
            'appointments' => $appointments,
            'doctors' => $doctors, 'nurses' => $nurses,
            'loggedInUserRole' => $loggedInUserRole,
        ]);
    }

    public function viewNurseCheckups()
    {
        $loggedInUserRole = auth()->user()->role;
        $appointments = Appointment::with('user')->get();
        $pendingAppointments = Appointment::with('user')
            ->where('status', 'For Checkup')
            ->get();
        $regularUsers = Role::where('name', 'regular_user')->firstOrFail()->users;
        $doctors = ScheduleAssignment::with('doctor')->get(); // Eager load the doctor relationship
        $nurses = ScheduleAssignment::with('nurse')->get(); // Eager load the doctor relationship
        return view('admin.nurseModule.nurse_checkups', ['pendingAppointments' => $pendingAppointments, 'appointments' => $appointments, 'doctors' => $doctors, 'nurses' => $nurses, 'loggedInUserRole' => $loggedInUserRole, 'regularUsers' => $regularUsers]);
    }

    public function viewCheckups()
    {
        $loggedInUserRole = auth()->user()->role;
        $appointments = Appointment::with('user')->get();
        $pendingAppointments = Appointment::with('user')
            ->where('status', 'For Checkup')
            ->get();
        $doctors = ScheduleAssignment::with('doctor')->get(); // Eager load the doctor relationship
        $nurses = ScheduleAssignment::with('nurse')->get(); // Eager load the doctor relationship
        return view('admin.checkups', ['pendingAppointments' => $pendingAppointments, 'appointments' => $appointments, 'doctors' => $doctors, 'nurses' => $nurses, 'loggedInUserRole' => $loggedInUserRole]);
    }

    public function viewAllCheckups(Request $request)
    {

        $doctorsFilter = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();

        $nursesFilter = User::whereHas('roles', function ($query) {
            $query->where('name', 'nurse');
        })->get();
        $loggedInUserRole = auth()->user()->role;
        $appointments = Appointment::with('user')->get();
        $courseMaintenance = Maintenance::where('title', 'Course')->first();
        $departmentMaintenance = Maintenance::where('title', 'Department')->first();
        $strandMaintenance = Maintenance::where('title', 'Strand')->first();

        // Fetch appointments with the "Done" status and eager load their checkups
        $doneAppointments = Appointment::with(['user', 'checkup'])
            ->where('status', 'Done')
            ->get();

        $doctors = ScheduleAssignment::with('doctor')->get(); // Eager load the doctor relationship
        $nurses = ScheduleAssignment::with('nurse')->get(); // Eager load the doctor relationship

        // Get filter values from the request
        $minDate = $request->input('min');
        $maxDate = $request->input('max');

        // Use the Checkup model for appointments
        $appointmentsFilter = Appointment::query()
            ->join('checkups', 'appointments.id', '=', 'checkups.appointment_id')
            ->select('checkups.*')
            ->when($minDate, function ($query, $minDate) {
                return $query->where('appointments.appointment_date', '>=', $minDate);
            })
            ->when($maxDate, function ($query, $maxDate) {
                return $query->where('appointments.appointment_date', '<=', $maxDate);
            })
            ->get();

        // Use the WalkInCheckup model for walk-in checkups
        $walkInCheckupsFilter = WalkInCheckup::query()
            ->when($minDate, function ($query, $minDate) {
                return $query->where('date', '>=', $minDate);
            })
            ->when($maxDate, function ($query, $maxDate) {
                return $query->where('date', '<=', $maxDate);
            })
            ->get();
        $walkInCheckups = WalkInCheckup::all();

        // Combine the results if needed

        return view('admin.allcheckups', [
            'doneAppointments' => $doneAppointments,
            'appointments' => $appointments,
            'doctors' => $doctors,
            'nurses' => $nurses,
            'loggedInUserRole' => $loggedInUserRole,
            'walkInCheckupsFilter' => $walkInCheckupsFilter,
            'appointmentsFilter' => $appointmentsFilter,
            'courseMaintenance' => $courseMaintenance,
            'departmentMaintenance' => $departmentMaintenance,
            'walkInCheckups' => $walkInCheckups,
            'doctorsFilter' => $doctorsFilter,
            'nursesFilter' => $nursesFilter,
            'strandMaintenance' => $strandMaintenance,
        ]);
    }

    public function viewNurseAllCheckups()
    {
        $loggedInUserRole = auth()->user()->role;
        $appointments = Appointment::with('user')->get();
        // Fetch appointments with the "Done" status and eager load their checkups
        $doneAppointments = Appointment::with(['user', 'checkup'])
            ->where('status', 'Done')
            ->get();

        $walkInCheckups = WalkInCheckup::all();
        $doctors = ScheduleAssignment::with('doctor')->get(); // Eager load the doctor relationship
        $nurses = ScheduleAssignment::with('nurse')->get(); // Eager load the doctor relationship
        return view('admin.nurseModule.nurse_all_checkups', [
            'doneAppointments' => $doneAppointments,
            'appointments' => $appointments,
            'doctors' => $doctors,
            'nurses' => $nurses,
            'loggedInUserRole' => $loggedInUserRole,
            'walkInCheckups' =>  $walkInCheckups,
        ]);
    }

    public function viewDoctorAllCheckups()
    {
        $appointments = Appointment::with('user')->get();
        // Fetch appointments with the "Done" status and eager load their checkups
        $doneAppointments = Appointment::with(['user', 'checkup'])
            ->where('status', 'Done')
            ->get();

        $doctors = ScheduleAssignment::with('doctor')->get(); // Eager load the doctor relationship
        $nurses = ScheduleAssignment::with('nurse')->get(); // Eager load the doctor relationship
        $walkInCheckups = WalkInCheckup::all();

        return view('admin.doctorModule.doctor_all_checkups', [
            'doneAppointments' => $doneAppointments,
            'appointments' => $appointments,
            'doctors' => $doctors,
            'nurses' => $nurses,
            'walkInCheckups' => $walkInCheckups,
        ]);
    }

    public function performCheckup($appointment_id)
    {
        $appointment = Appointment::find($appointment_id);

        // Fetch the associated user
        $user = $appointment->user;
        // Fetch medical records for the user
        $medicalRecord = $user->medicalRecords;

        // Fetch all checkups associated with the user
        $checkups = Checkup::whereHas('appointment', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        $loggedInDoctor = Auth::user();

        return view('admin.doctorModule.checkup_form', ['appointment' => $appointment, 'medicalRecord' => $medicalRecord, 'user' => $user, 'checkups' => $checkups, 'loggedInDoctor'=> $loggedInDoctor,]);
    }

    //View page of the Walkin Checkup
    public function performWalkCheckup(Request $request, $userId)
    {
        // Fetch the user based on the provided user ID
        $user = User::find($userId);

        if (!$user) {
            // Handle the case where the user is not found
            abort(404); // You can customize this based on your application's logic
        }

        // Fetch medical records for the user
        $medicalRecord = $user->medicalRecords;

        // Fetch the appointment associated with the user
        $appointment = Appointment::where('user_id', $userId)->first();

        // Fetch all checkups associated with the user
        $checkups = Checkup::whereHas('appointment', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
        $walkInCheckups = WalkInCheckup::where('patient_id', $userId)->get();

        $maintenance = Maintenance::where('title', 'Appointment Time')->first();
        $staffSchedTime = Maintenance::where('title', 'Appointment Time')->first();
        $loggedInDoctor = Auth::user();

        return view('admin.doctorModule.walkInCheckupForm', [
            'appointment' => $appointment,
            'medicalRecord' => $medicalRecord,
            'user' => $user,
            'checkups' => $checkups,
            'maintenance' => $maintenance,
            'walkInCheckups' => $walkInCheckups,
            'staffSchedTime' => $staffSchedTime,
            'loggedInDoctor' => $loggedInDoctor,
        ]);
    }

    public function viewUsers()
    {
        $users = User::with(['course', 'department'])->get();
        $roles = Role::all();
        $months = [
            '1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April',
            '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August',
            '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December',
        ];
        $userCategories = [
            '1' => 'Student',
            '2' => 'Faculty',
            '3' => 'Staff',
        ];

        return view('admin.users_view', ['users' => $users, 'months' => $months, 'roles' => $roles, 'userCategories' => $userCategories]);
    }

    //View Page of the nurse pending appointments
    public function viewNursePendingAppointments()
    {
        // Get the currently logged-in doctor's ID
        $nurseId = Auth::user()->id;
        $appointments = Appointment::with('user')->get();
        $pendingAppointments = Appointment::with('user')
            ->where('status', 'Approved')
            ->where('nurse_id', $nurseId)
            ->get();
        // Get expired appointments for the logged-in doctor
        $expiredAppointments = Appointment::with('user')
            ->where('status', 'Expired')
            ->where('nurse_id', $nurseId)
            ->get();
        $approvedAppointmentsCount = $pendingAppointments->count();
        $expiredAppointmentsCount = $expiredAppointments->count();
        $doctors = ScheduleAssignment::with('doctor')->get();
        $nurses = ScheduleAssignment::with('nurse')->get();
        // Log::info('Appointment Count: ' . count($appointments));
        return view('admin.nurseModule.pending_appointments', [
            'pendingAppointments' => $pendingAppointments,
            'appointments' => $appointments,
            'doctors' => $doctors,
            'nurses' => $nurses,
            'approvedAppointmentsCount' => $approvedAppointmentsCount,
            'expiredAppointmentsCount' => $expiredAppointmentsCount,
        ]);
    }

    //Doctor view of pending appointments/checkups
    public function viewDoctorCheckupAppointments()
    {
        // Get the currently logged-in doctor's ID
        $doctorId = Auth::user()->id;
        $appointments = Appointment::with('user')->get();
        $pendingAppointments = Appointment::with('user')
            ->where('status', 'For Checkup')
            ->where('doctor_id', $doctorId) // Filter by the doctor's ID
            ->get();

        // Get expired appointments for the logged-in doctor
        $expiredAppointments = Appointment::with('user')
            ->where('status', 'Expired')
            ->where('doctor_id', $doctorId)
            ->get();

        $regularUsers = Role::where('name', 'regular_user')->firstOrFail()->users;

        $approvedAppointmentsCount = $pendingAppointments->count();
        $expiredAppointmentsCount = $expiredAppointments->count();
        $doctors = ScheduleAssignment::with('doctor')->get(); // Eager load the doctor relationship
        $nurses = ScheduleAssignment::with('nurse')->get(); // Eager load the doctor relationship
        // Log::info('Appointment Count: ' . count($appointments));
        return view('admin.doctorModule.doctor_pending_appoint', [
            'pendingAppointments' => $pendingAppointments,
            'appointments' => $appointments,
            'doctors' => $doctors,
            'nurses' => $nurses,
            'approvedAppointmentsCount' => $approvedAppointmentsCount,
            'regularUsers' => $regularUsers,
            'expiredAppointmentsCount' => $expiredAppointmentsCount,
        ]);
    }

    //View page for Schedule Assigns of staffs
    public function assignSchedule()
    {
        // $schedules = ScheduleAssignment::orderBy('updated_at', 'desc')->get();
        $maintenance = Maintenance::where('title', 'Appointment Time')->first();
        $maintenances = Maintenance::where('title', 'Satellite')->first();
        $staffSchedTime = Maintenance::where('title', 'Staff Schedule Time')->first();
        $schedules = ScheduleAssignment::latest()->get();
        // $satelites = Satellite::all();
        return view('admin.staff_schedule', compact('schedules', 'maintenance', 'maintenances', 'staffSchedTime'));
    }

    public function assignRoles(User $user)
    {
        $roles = Role::all();
        return view('admin.assign_roles', compact('user', 'roles'));
    }

    public function processAssignRoles(Request $request, User $user)
    {
        try {
            // Retrieve selected roles from the request
            $selectedRoles = $request->input('roles', []);

            // Sync the user's roles with the selected roles
            $user->syncRoles($selectedRoles);

            // Success response
            Alert::success('Success', 'Roles assigned successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            // Error response
            Alert::error('Error', 'An error occurred while assigning roles');
            return redirect()->back();
        }
    }

    public function doctorStore(Request $request)
    {
        try {
            $data = $request->validate([
                'doctor_id' => 'required|exists:users,id,user_type_id,3',
                'doctor_start_time' => 'required|date_format:H:i',
                'doctor_end_time' => 'required|date_format:H:i',
                'doctor_start_date' => 'required|date',
                'doctor_end_date' => 'required|date',
            ]);


            $doctor = \App\Models\User::where('id', $data['doctor_id'])
                ->where('user_type_id', 3)
                ->first();

            if (!$doctor) {
                return redirect()->back()->with('error', 'Doctor not found.');
            }

            // Create a new schedule assignment record in the database
            \App\Models\ScheduleAssignment::create([
                'doctor_id' => $doctor->id,
                'start_time' => $data['doctor_start_time'],
                'end_time' => $data['doctor_end_time'],
                'start_date' => $data['doctor_start_date'],
                'end_date' => $data['doctor_end_date'],
            ]);
            //Alert::success('Success', 'Schedule assignment created successfully.');
            return redirect()->route('pendingAppointments')->with('success', 'Schedule assignment created successfully.');
        } catch (\Exception $e) {
            // Handle and log any exceptions or errors
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function nurseStore(Request $request)
    {
        //dd($request->all()); // To check the data from the form
        try {
            $data = $request->validate([
                'nurse_id' => 'required|exists:users,id,user_type_id,4',
                'nurse_start_time' => 'required|date_format:H:i',
                'nurse_end_time' => 'required|date_format:H:i',
                'nurse_start_date' => 'required|date',
                'nurse_end_date' => 'required|date',
            ]);


            $nurse = \App\Models\User::where('id', $data['nurse_id'])
                ->where('user_type_id', 4)
                ->first();

            if (!$nurse) {
                return redirect()->back()->with('error', 'Nurse not found.');
            }

            // Create a new schedule assignment record in the database
            \App\Models\ScheduleAssignment::create([
                'nurse_id' => $nurse->id,
                'start_time' => $data['nurse_start_time'],
                'end_time' => $data['nurse_end_time'],
                'start_date' => $data['nurse_start_date'],
                'end_date' => $data['nurse_end_date'],
            ]);
            //Alert::success('Success', 'Schedule assignment created successfully.');
            return redirect()->route('pendingAppointments')->with('success', 'Schedule assignment created successfully.');
        } catch (\Exception $e) {
            // Handle and log any exceptions or errors
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function scheduleStore(Request $request)
    {
        try {
            // dd($request->all());
            // Validate the form data
            // Convert the time input to a valid time format before validation
            $start_time = date('H:i:s', strtotime($request->input('start_time')));
            $end_time = date('H:i:s', strtotime($request->input('end_time')));

            // Check if the conversion was successful
            if ($start_time === false || $end_time === false) {
                // Handle invalid time format
                return redirect()->back()->with('error', 'Invalid time format.');
            }

            $data = $request->validate([
                'satellite' => 'required',
                'nurse_id' => 'required|exists:users,id',
                'doctor_id' => 'required|exists:users,id',
                'start_time' => 'required',
                'end_time' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            // Fetch the nurse and doctor records
            $nurse = \App\Models\User::where('id', $data['nurse_id'])->first();
            $doctor = \App\Models\User::where('id', $data['doctor_id'])->first();

            // Check if the selected user is a nurse and doctor
            if (!$nurse->hasRole('nurse')) {
                return redirect()->back()->with('error', 'The selected user is not a nurse.');
            }

            if (!$doctor->hasRole('doctor')) {
                return redirect()->back()->with('error', 'The selected user is not a doctor.');
            }

            $currentDateTime = now(); // Get the current date and time

            if ($currentDateTime < $data['start_date'] . ' ' . $data['start_time']) {
                // Schedule is pending (current date and time is before start_date and start_time)
                $status = 'Pending';
            } elseif ($currentDateTime >= $data['start_date'] . ' ' . $data['start_time'] && $currentDateTime <= $data['end_date'] . ' ' . $data['end_time']) {
                // Schedule is on going (current date and time is within the date and time range)
                $status = 'On going';
            } else {
                // Schedule is done (current date and time is after the end_date and end_time)
                $status = 'Done';
            }

            // Check if the nurse and doctor have overlapping schedules
            // $overlappingSchedules = \App\Models\ScheduleAssignment::where(function ($query) use ($data) {
            //     $query->where('nurse_id', $data['nurse_id'])
            //         ->Where('doctor_id', $data['doctor_id']);
            // })->where(function ($query) use ($data, $start_time, $end_time) {
            //     $query->where(function ($q) use ($data, $start_time) {
            //         $q->where('start_date', '<=', $data['start_date'])
            //             ->where('end_date', '>=', $data['start_date'])
            //             ->where('end_time', '>=', $start_time);
            //     })->orWhere(function ($q) use ($data, $end_time) {
            //         $q->where('start_date', '<=', $data['end_date'])
            //             ->where('end_date', '>=', $data['end_date'])
            //             ->where('start_time', '<=', $end_time);
            //     });
            // })->whereIn('status', ['Pending', 'On going'])->exists();

            $overlappingSchedules = \App\Models\ScheduleAssignment::where(function ($query) use ($data) {
                $query->where('nurse_id', $data['nurse_id'])
                    ->orWhere('doctor_id', $data['doctor_id']);
            })->where(function ($query) use ($data, $start_time, $end_time) {
                $query->where('start_date', '<=', $data['end_date'])
                    ->where('end_date', '>=', $data['start_date'])
                    ->where(function ($q) use ($start_time, $end_time) {
                        $q->where(function ($qq) use ($start_time) {
                            $qq->where('start_time', '<=', $start_time)
                                ->where('end_time', '>=', $start_time);
                        })->orWhere(function ($qq) use ($end_time) {
                            $qq->where('start_time', '<=', $end_time)
                                ->where('end_time', '>=', $end_time);
                        });
                    });
            })->whereIn('status', ['Pending', 'On going'])->exists();

            if ($overlappingSchedules) {
                Alert::info('Info', 'There are already pending/ongoing schedule for the nurse and doctor on the same date.');
                return redirect()->back()->with('error', 'Nurse and doctor already have overlapping schedules at the same date and time.');
            }

            // Create a new schedule assignment record in the database
            \App\Models\ScheduleAssignment::create([
                'nurse_id' => $nurse->id,
                'doctor_id' => $doctor->id,
                'satellite' => $data['satellite'],
                'start_time' => $start_time,
                'end_time' => $end_time,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'status' => $status,
            ]);

            // Redirect with a success message
            Alert::success('Success', 'Schedule assignment created successfully.');
            return redirect()->back()->with('success', 'Schedule assignment created successfully.');
        } catch (\Exception $e) {
            Alert::error('Error', 'There is a problem in creating the schedule');
            Log::error('Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            // Handle and log any exceptions or errors
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function showPermissionForm()
    {
        // Retrieve all permissions
        $permissions = Permission::all();
        $roles = Role::with('permissions')->get();

        return view('admin.permissions', compact('permissions', 'roles'));
    }


    // public function scheduleStore(Request $request)
    // {
    //     try {
    //         //  dd($request->all());
    //         // Validate the form data
    //         // Convert the time input to a valid time format before validation
    //         $start_time = date('H:i', strtotime($request->input('start_time')));
    //         $end_time = date('H:i', strtotime($request->input('end_time')));

    //         // Check if the conversion was successful
    //         if ($start_time === false || $end_time === false) {
    //             // Handle invalid time format
    //             return redirect()->back()->with('error', 'Invalid time format.');
    //         }

    //         $data = $request->validate([
    //             'satellite' => 'required',
    //             'nurse_id' => 'required|exists:users,id',
    //             'doctor_id' => 'required|exists:users,id',
    //             'start_time' => 'required|date_format:H:i A',
    //             'end_time' => 'required|date_format:H:i A',
    //             'start_date' => 'required|date',
    //             'end_date' => 'required|date',
    //         ]);

    //         // Fetch the nurse and doctor records
    //         $nurse = \App\Models\User::where('id', $data['nurse_id'])->first();
    //         $doctor = \App\Models\User::where('id', $data['doctor_id'])->first();

    //         // Check if the selected user is a nurse and doctor
    //         if (!$nurse->hasRole('nurse')) {
    //             return redirect()->back()->with('error', 'The selected user is not a nurse.');
    //         }

    //         if (!$doctor->hasRole('doctor')) {
    //             return redirect()->back()->with('error', 'The selected user is not a doctor.');
    //         }

    //         $currentDateTime = now(); // Get the current date and time

    //         if ($currentDateTime < $data['start_date'] . ' ' . $data['start_time']) {
    //             // Schedule is pending (current date and time is before start_date and start_time)
    //             $status = 'Pending';
    //         } elseif ($currentDateTime >= $data['start_date'] . ' ' . $data['start_time'] && $currentDateTime <= $data['end_date'] . ' ' . $data['end_time']) {
    //             // Schedule is on going (current date and time is within the date and time range)
    //             $status = 'On going';
    //         } else {
    //             // Schedule is done (current date and time is after the end_date and end_time)
    //             $status = 'Done';
    //         }

    //         // Create a new schedule assignment record in the database
    //         \App\Models\ScheduleAssignment::create([
    //             'nurse_id' => $nurse->id,
    //             'doctor_id' => $doctor->id,
    //             'satellite' => $data['satellite'],
    //             'start_time' => $start_time,
    //             'end_time' => $end_time,
    //             'start_date' => $data['start_date'],
    //             'end_date' => $data['end_date'],
    //             'status' => $status,
    //         ]);

    //         // Redirect with a success message
    //         Alert::success('Success', 'Schedule assignment created successfully.');
    //         return redirect()->back()->with('success', 'Schedule assignment created successfully.');
    //     } catch (\Exception $e) {
    //         Alert::error('Error', 'There is a problem in creating the schedule');
    //         Log::error('Error: ' . $e->getMessage());
    //         Log::error('Stack Trace: ' . $e->getTraceAsString());
    //         // Handle and log any exceptions or errors
    //         return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    //     }
    // }
}
