<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicalRecord;
use App\Models\Maintenance;
use App\Models\UserCategory;
use App\Models\Department;
use App\Models\Course;
use App\Models\Strand;
use App\Models\YearLevel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VerifyEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\VerificationToken;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm()
    {
        $blood_types = Maintenance::where('title', 'Blood Types')->first();
        $userCategories = UserCategory::all();
        $departments = Department::all();
        $strands = Strand::all();
        $courses = Course::all();
        $yearLevels = YearLevel::all();

        return view('auth.register', compact('blood_types', 'userCategories', 'departments', 'yearLevels', 'strands', 'courses', 'yearLevels'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthdate' => 'required|date',
            'age' => ['required', 'integer'],
            'blood_type' => ['required', 'string', 'max:255'],
            'is_pwd' => ['required', 'boolean'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'civil_status' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'student_id' => ['nullable', 'unique:users,student_id'],
            'guardian' => ['required', 'string', 'max:255'],
            'guardian_contact_number' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        try {
            $birthdate = explode('-', $data['birthdate']);

            $user = User::create([
                'name' => $data['name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'birth_day' => $birthdate[2], // Extract day
                'birth_month' => $birthdate[1], // Extract month
                'birth_year' => $birthdate[0], // Extract year
                'age' => $data['age'],
                'blood_type' => $data['blood_type'],
                'is_pwd' => $data['is_pwd'],
                'email' => $data['email'],
                'civil_tatus' => $data['civil_status'],
                'sex' => $data['sex'],
                'phone_number' => $data['phone_number'],
                'address' => $data['address'],
                'user_category_id' => $data['user_category_id'],
                'department_id' => $data['department_id'] ?? null,
                'student_id' => $data['student_id'] ?? null,
                'year_level' => $data['year_level'] ?? null,
                'strand_id' => $data['strand_id'] ?? null,
                'course_id' => $data['course_id'] ?? null,
                'contact_person' => $data['guardian'],
                'contact_person_number' => $data['guardian_contact_number'],
                'password' => Hash::make($data['password']),
            ])->assignRole('regular_user');

            // $this->createMedicalRecord($user->id, $data['is_pwd'], $data['blood_type']);

            return $user;
        } catch (\Exception $e) {
            // Log the error or handle it as per your application's requirement
            Log::error('Error creating user: ' . $e->getMessage());
            Alert::info('Error', 'There is a problem creating your account. Please try again.');
        }
    }


    private function createMedicalRecord($userId, $isPwd, $bloodType)
    {
        try {
            // Retrieve user data
            // $userData = User::where('id', $userId)->first();

            $userData = User::select('users.*', 'strand.name as strand_name', 'course.course_name', 'department.name as department_name', 'year_level.name as year_level_name')
                        ->leftJoin('strand', 'users.strand_id', '=', 'strand.id')
                        ->leftJoin('course', 'users.course_id', '=', 'course.id')
                        ->leftJoin('department', 'users.department_id', '=', 'department.id')
                        ->leftJoin('year_level', 'users.year_level', '=', 'year_level.id')
                        ->where('users.id', $userId)
                        ->first();



            if (!$userData) {
                // Handle the case where user data is not found
                Log::error("User data not found for user with ID: $userId");
                return;
            }

            // Extract user information
            $userName = $userData->name . ' ' . $userData->middle_name . ' ' . $userData->last_name;
            // $userYear = optional($userData->year_level)->name;
            // Create medical record
            MedicalRecord::create([
                'user_id' => $userId,
                'name' => $userName,
                'strand' => $userData->strand_name, // Use the retrieved strand name
                'course' => $userData->course_name, // Use the retrieved course name
                'year_level' => $userData->year_level_name, // Use the retrieved year level name
                'department' => $userData->department_name, // Use the retrieved department name
                'address' => $userData->address,
                'contact_number' => $userData->phone_number,
                'age' => $userData->age,
                'gender' => $userData->sex,
                'civil_status' => $userData->civil_tatus,
                'contact_person' => $userData->contact_person,
                'contactPerson_number' => $userData->contact_person_number,
                'is_pwd' => $isPwd,
                'blood_type' => $bloodType,
                // Add other medical record fields
            ]);

        } catch (\Exception $e) {
            // Log the error or handle it as per your application's requirement
            Log::error('Error creating medical record: ' . $e->getMessage());
            Alert::info('Error', 'There is a problem creating your account. Please try again.');
        }
    }



    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // Create the user
        $user = $this->create($request->all());

        // // Generate and store the verification token
        // $this->generateVerificationToken($user);

        // Create the medical record for the user
        $this->createMedicalRecord($user->id, $request->is_pwd, $request->blood_type);

        // Trigger the event to send verification email
        event(new Registered($user));

        // After registering, log the user in
        Auth::login($user);
        Alert::success('Success', 'Register Successfully!');

        // Redirect to the verification notice page
        return redirect()->route('verification.notice')->with('success', 'Registration successful!');
    }

    // protected function generateVerificationToken($user)
    // {
    //     // Generate and store the verification token
    //     $verificationToken = VerificationToken::create([
    //         'user_id' => $user->id,
    //         'token' => encrypt(Str::random(40)),
    //         'expires_at' => now()->addMinutes(3)->toDateTimeString(), // Token expiration time (3 minutes from now)
    //     ]);
    // }
}
