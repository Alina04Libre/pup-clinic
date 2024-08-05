<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCategory;
use App\Models\Appointment;
use App\Models\Checkup;
use App\Models\Announcement;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ConsentForm;
use App\Models\Maintenance;
use App\Models\MedicalRecord;
use App\Models\ScheduleAssignment;
use App\Models\WalkInCheckup;
use Carbon\Carbon;

class UserController extends Controller
{
    public function user_dashboard()
    {
        $user = Auth::user();
        if ($user->hasRole('regular_user')) {
            $announcements = Announcement::orderBy('created_at', 'desc')->get();
            // Redirect to user dashboard (for regular users)
            return view('user.user_dashboard', compact('announcements'))->with('message', 'Login Successful');
        }
    }

    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the uploaded file
        if ($request->hasFile('profile_photo')) {
            $imagePath = $request->file('profile_photo')->store('profile-photos', 'public');

            // Update the user's profile_photo_path with the image path
            $user = auth()->user(); // Get the authenticated user
            $user->update(['profile_photo_path' => $imagePath]);
        }

        return redirect()->back()->with('success', 'Profile picture uploaded successfully.');
    }

    public function create()
    {

        $userCategory = UserCategory::all(); // Retrieve all user categories

        return view('user.create_account', ['userCategories' => $userCategory]);
        //return view('user.create_account');
    }

    public function walkInView()
    {
        // Retrieve the Zoom link from the database
        $zoomLink = Maintenance::where('title', 'Zoom Link')->first();
        // Retrieve staff schedules for the current day between 3:00 PM and 5:00 PM

        // Retrieve staff schedules for today with a date range overlapping today
        $staffSchedules = ScheduleAssignment::with(['doctor', 'nurse'])
            ->where(function ($query) {
                $query->whereDate('start_date', '<=', now()->toDateString())
                    ->whereDate('end_date', '>=', now()->toDateString());
            })
            ->where(function ($query) {
                $query->where('start_time', ['15:00:00'])
                    ->orWhere('end_time', ['17:00:00']);
            })
            ->get();
        $maintenance = Maintenance::where('title', 'Appointment Time')->first();

        // Pass the $zoomLink and $staffSchedules variables to the view
        return view('user.walk_in', ['zoomLink' => $zoomLink, 'staffSchedules' => $staffSchedules, 'maintenance' => $maintenance]);
    }

    public function viewAnnouncements()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        return view('viewAnnouncements', compact('announcements'));
    }

    //Function to check if the user has pending appointment
    public function hasPendingAppointmentsAndConsentForms($userId)
    {
        return Appointment::where('user_id', $userId)
            ->whereIn('status', ['Pending', 'Approved', 'For Checkup'])
            ->exists();
    }

    public function consentForm()
    {
        $userId = Auth::user()->id;

        if ($this->hasPendingAppointmentsAndConsentForms($userId)) {
            Alert::info('info', 'You already have a pending/ongoing appointment. Please complete or cancel them before creating a new one.');
            return redirect()->back()->with('error', 'You already have a pending/ongoing appointment. Please complete or cancel them before creating a new one.');
        }

        // $current_time = now();
        // $start_time = now()->setHour(9)->setMinute(0)->setSecond(0);
        // $end_time = now()->setHour(28)->setMinute(0)->setSecond(0);

        // if ($current_time >= $start_time && $current_time <= $end_time) {
        $user = auth()->user();
        // $user = User::find(Auth::id());
         // Calculate the age based on the birthdate fields
        $birthDate = Carbon::createFromDate($user->birth_year, $user->birth_month, $user->birth_day);
        $age = $birthDate->age;
        return view('forms.consent', compact('user', 'age'));
        // }
        // else
        // {
        //     Alert::info('info', 'Appointments are only available from 9:00 AM to 5:00 PM. Please come back tomorrow.');
        //     return redirect('/userdashboard');
        // }
    }

    public function userProfileShow()
    {
        $user = User::with(['course', 'department', 'strand', 'yearLevel'])->find(Auth::id());
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

        return view('user.profile', compact('user', 'months', 'userCategories'));
    }

    public function userProfileEdit()
    {
        $user = User::with(['course', 'department', 'strand', 'yearLevel'])->find(Auth::id());
        $months = [
            '1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April',
            '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August',
            '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December',
        ];
        $course = Maintenance::where('title', 'Course')->first();
        $department = Maintenance::where('title', 'Department')->first();
        $strand = Maintenance::where('title', 'Strand')->first();
        $blood_types = Maintenance::where('title', 'Blood Types')->first();
        $userCategories = [
            '1' => 'Student',
            '2' => 'Faculty',
            '3' => 'Staff',
        ];

        return view('user.edit_profile', compact('user', 'months', 'userCategories', 'course', 'department', 'blood_types'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'middle_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'age' => 'required|numeric',
                'email' => 'required|email',
                'civil_status' => 'required|in:Single,Married,Widowed',
                'birth_month' => 'required|numeric|between:1,12',
                'birth_day' => 'required|numeric|between:1,31',
                'birth_year' => 'required|numeric|between:' . (date('Y') - 100) . ',' . date('Y'),
                'sex' => 'required|in:Male,Female',
                'phone_number' => 'nullable|numeric|digits:11',
                'address' => 'required|string|max:500',
                'contact_person' => 'required|string|max:255',
                'contact_person_number' => 'nullable|numeric|digits:11',
                'course' => 'nullable',
                'department' => 'nullable',
                'strand' => 'nullable',
                'yearLevel' => 'nullable',
                'is_pwd' => 'nullable|boolean',
                'blood_type' => 'nullable|string|max:255',

                // Add more fields and rules as needed
            ]);

            // Update the user's profile information
            $user = Auth::user(); // Laravel's built-in Auth
            $medicalRecord = $user->medicalRecords;
            $user->update([
                'name' => $request->input('name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'age' => $request->input('age'),
                'email' => $request->input('email'),
                'civil_tatus' => $request->input('civil_status'),
                'birth_month' => $request->input('birth_month'),
                'birth_day' => $request->input('birth_day'),
                'birth_year' => $request->input('birth_year'),
                'sex' => $request->input('sex'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'contact_person' => $request->input('contact_person'),
                'contact_person_number' => $request->input('contact_person_number'),
                'course_id' => $request->input('course'),
                'department_id' => $request->input('department'),
                'strand_id' => $request->input('strand'),
                'year_level' => $request->input('yearLevel'),

                // Update more fields as needed
            ]);

            if ($medicalRecord) {
                $medicalRecord->update([
                    'is_pwd' => $request->input('is_pwd'),
                    'blood_type' => $request->input('blood_type'),
                    // ... other fields ...
                ]);
                Alert::success('Success', 'Edit has been saved!');
                // Conditionally set the redirect route based on the user's role
                $redirectRoute = $user->hasRole('regular_user') ? 'profile_view' : 'admin.profile';

                // Redirect to the appropriate route
                return redirect()->route($redirectRoute)->with('success', 'Profile updated successfully!');
            } else {
                Alert::success('Success', 'Edit has been saved!');
                // Conditionally set the redirect route based on the user's role
                $redirectRoute = $user->hasRole('regular_user') ? 'profile_view' : 'admin.profile';

                // Redirect to the appropriate route
                return redirect()->route($redirectRoute)->with('success', 'Profile updated successfully!');
            }
        } catch (\Exception $e) {
            // Log any exceptions that occur during the update
            \Log::error('Error while updating' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while updating: ' . $e->getMessage());
        }
    }


    public function adminProfileShow()
    {
        $user = User::find(Auth::id());
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

        return view('admin.adminProfile', compact('user', 'months', 'userCategories'));
    }

    public function showAppoint()
    {
        $user = Auth::user(); // Get the currently authenticated user
        $appointments = Appointment::with('nurse', 'doctor')->get();
        $consents = ConsentForm::all();
        $userCategories = UserCategory::pluck('name', 'id');
        // Retrieve the user's pending appointments
        $pendingAppointments = Appointment::where('user_id', $user->id)
            ->where('status', 'Pending')
            ->get();

        $historyAppointments = Appointment::where('user_id', $user->id)
            ->whereIn('status', ['Done', 'Declined', 'Approved', 'For Checkup', 'Expired'])
            ->get();

        $reAppointments = Appointment::where('user_id', $user->id)
            ->where('status', 'Re-Scheduled')
            ->get();

        $checkups = Checkup::whereHas('appointment', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        $walkInCheckups = WalkInCheckup::where('patient_id', $user->id)->get();

        return view('user.user_appointment', compact('pendingAppointments', 'historyAppointments', 'reAppointments', 'appointments', 'consents', 'checkups', 'walkInCheckups'));
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout Successful!');
    }

    public function process(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required',
            'birth_month' => 'required',
            'birth_day' => 'required',
            'birth_year' => 'required',
            'password' => 'required',


        ]);

        if (auth()->attempt($data)) {
            $request->session()->regenerate();

            //return redirect('/userdashboard')->with('message', 'Login Succesful');
            return redirect('/userdashboard');
            session()->flash('message', 'Login Succesful');
        }
        /*return back()->withErrors(['student_id' => 'Login Failed! Student Number Incorrect'])->onlyInput('student_id');*/
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'student_id' => 'required_if:user_category_id,1', // Required if user category is "Student" (ID 1)
            'birth_month' => 'required_if:user_category_id,1',
            'birth_day' => 'required_if:user_category_id,1',
            'birth_year' => 'required_if:user_category_id,1',
            'email' => 'required|email',
            'password' => 'required',
            'user_category_id' => 'required',
        ]);

        $data['password'] = Hash::make($data['password']);

        $newUser = User::create($data);

        return redirect('/')->with('message', 'Create Successful!');
    }

    public function userViewMedical()
    {
        $userId = auth()->id();

        // Fetch the medical record associated with the user
        $medicalRecord = MedicalRecord::where('user_id', $userId)->first();

        // Check if medical record exists for the user
        if (!$medicalRecord) {
            // Handle case where medical record does not exist
            return redirect()->back()->with('error', 'Medical record not found.');
        }

        // Retrieve the user details
        $user = $medicalRecord->user;

        // Fetch walk-in checkups for the user
        $walkInCheckups = WalkInCheckup::where('patient_id', $userId)->get();

        // Fetch the appointment associated with the user
        $appointment = Appointment::where('user_id', $userId)->first();

        // Fetch all checkups associated with the user's appointments
        $checkups = Checkup::whereHas('appointment', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        // Pass data to the view
        return view('user.user_medical_record', [
            'medicalRecord' => $medicalRecord,
            'user' => $user,
            'appointment' => $appointment,
            'checkups' => $checkups,
            'walkInCheckups' => $walkInCheckups
        ]);
    }
}
