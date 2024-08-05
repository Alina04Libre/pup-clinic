<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\FacultyLoginController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckupController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/userlogin', [UserController::class, 'index'])->name('userlogin')->middleware('guest');


/*Route::middleware(['auth', 'can:view management'])->group(function () {
    
});*/



Route::middleware(['auth', 'role:regular_user'])->group(function () {
    Route::get('/userdashboard', [UserController::class, 'user_dashboard']);
    Route::get('/viewAnnouncements', [UserController::class, 'viewAnnouncements'])->name('viewAnnouncement');
    Route::get('/appoint', [UserController::class, 'showAppoint'])->name('show_appoint');
    Route::get('/onlineConsultation', [UserController::class, 'walkInView']);
    Route::post('/logout', [UserController::class, 'userlogout']);
    Route::get('/user/consent', [UserController::class, 'consentForm'])->name('consent.create');
    Route::post('consent-form/store', [AppointmentController::class, 'storeConsentForm'])->name('consent-form.store');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/profile', [UserController::class, 'userProfileShow'])->name('profile_view');
    Route::get('/user_medicalrecord', [UserController::class, 'userViewMedical'])->name('user_view_medical_record');


});


//minano
Route::get('unreadcount', function () {
    $count = auth()->user()->getMessageCount();
    return response()->json(['count' => $count]);
})->name('unreadcount');
//minano



Route::middleware(['auth', 'role:regular_user|superadmin'])->group(function () {
    Route::post('/get-available-times', [AppointmentController::class, 'getAvailableTimes'])->name('get.available.times');
});

Route::middleware(['auth', 'role:superadmin|nurse|doctor'])->group(function () {
    Route::get('/admin-profile', [UserController::class, 'adminProfileShow'])->name('admin.profile');
    Route::get('/view-announcements', [AdminController::class, 'viewAnnouncements'])->name('view.announcement');
    Route::get('/medicalRecords', [AdminController::class, 'medicalRecords'])->name('view_medical_records');
    Route::get('/generate-appointment-pdf/{id}', [AppointmentController::class, 'generateAppointmentPDF'])->name('generate-appointment-pdf');
    Route::get('/new-medical', [AdminController::class, 'newMedicalRecord'])->name('new-medical');
    Route::get('/checkup-form/{appointment_id}', [AdminController::class, 'performCheckup'])->name('checkup-form');
    Route::get('/walk-in-checkup-form/{userId}', [AdminController::class, 'performWalkCheckup'])->name('walk-in-checkup-form')->middleware('check.schedule');
    Route::post('/checkup-form/store/{appointment_id}', [CheckupController::class, 'store'])->name('checkup-form.store');
    Route::post('walk-in-checkups/{user_id}', [CheckupController::class, 'walkInStore'])->name('walkincheckups.store');
    Route::get('/create-medical/{patientId}', [AdminController::class, 'editMedicalRecords'])->name('medical-record.edit');
    Route::get('/view-medical/{patientId}', [AdminController::class, 'viewMedicalRecords'])->name('medical-record.view');
    Route::get('/export-medical-record/{userId}', [MedicalController::class, 'generateMedicalRecordPDF'])->name('generate-medical-record-pdf');
    Route::post('/export-medical-records', [MedicalController::class, 'generateFilteredMedicalRecordsPDF'])->middleware('auth')->name('export.medical.records');
    Route::post('/medical-record/store/{patientId}', [MedicalController::class, 'store'])->name('medical-record.store');

    Route::get('/export-checkup-record/{appointment_id}', [CheckupController::class, 'generateCheckupPDF'])->name('generate-checkup-record-pdf');
    Route::get('/export-walk-checkup-record/{walkInid}', [CheckupController::class, 'generateWalkInCheckupPDF'])->name('generate-walk-checkup-record-pdf');

    // Define a route for editing a medical record
    Route::get('/edit-medical-record/{patientId}', [AdminController::class, 'editMedicalRecords2'])
        ->name('medical.edit');

    // You can also define a route to handle the form submission for the edit operation
    Route::put('/medical-record/{patientId}', [MedicalController::class, 'edit'])
        ->name('medical-record.update');

    //faqs
    Route::get('/faqs', [AdminController::class, 'makeFaqs'])->name('make.faqs');
    Route::get('/view-faqs', [AdminController::class, 'viewFaqs'])->name('view.faqs');
    Route::post('/makeFaqs', [AdminController::class, 'faqStore'])->name('faq.store');
    Route::get('/editFaqs/{id}', [AdminController::class, 'editFaqs'])->name('edit.faqs');
    Route::put('/updateFaqs/{id}', [AdminController::class, 'updateFaqs'])->name('update.faqs');
    Route::post('/delete-faqs/{id}', [AdminController::class, 'deleteFaqs'])->name('delete.faqs');

});

Route::middleware(['auth', 'role:superadmin|nurse|doctor|regular_user'])->group(function () {
    Route::get('/get-appointment-details/{id}', [AdminController::class, 'getAppointmentDetails']);
    Route::get('/get-checkup-details/{id}', [CheckupController::class, 'getCheckupDetails']);
    Route::post('/profile/upload', [UserController::class, 'upload'])->name('profile.upload');
    Route::get('/profile-edit', [UserController::class, 'userProfileEdit'])->middleware('auth')->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/admindashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/pendingAppointments', [AdminController::class, 'viewPendingAppointments']);
    Route::get('/announcements', [AdminController::class, 'makeAnnouncements'])->name('make.announcement');
    Route::post('/make-announcements', [AdminController::class, 'announcementStore'])->name('announcement.store');
    Route::post('/uploadImage', [AdminController::class, 'uploadImage'])->name('uploadImage');
    Route::get('/edit-announcement/{id}', [AdminController::class, 'editAnnouncements'])->name('edit.announcement');
    Route::post('/update-announcement-status/{announcementId}', [AdminController::class, 'updateStatus'])->name('update.announcement.status');
    Route::put('/update-announcement/{id}', [AdminController::class, 'updateAnnouncement'])->name('update.announcement');
    Route::post('/delete-announcement/{id}', [AdminController::class, 'deleteAnnouncement'])->name('delete.announcement');
    Route::post('/appointments/decline/{id}', [AppointmentController::class, 'declineAppointment'])->name('appointments.decline');
    Route::post('/appointments/reschedule/{id}', [AppointmentController::class, 'reschedule'])->name('appointments.reschedule');
    Route::post('/re-assign-nurse/{id}', [AppointmentController::class, 'ReassignNurse'])->name('appointments.reassignNurse');
    Route::get('/available-nurse/{appointmentDate}/{appointmentTime}', [AppointmentController::class, 'getAvailableNurse'])->name('getAvailableNurse');
    Route::post('/assign-nurse/{id}', [AppointmentController::class, 'assignNurse'])->name('appointments.assignNurse');
    Route::get('/appointment-history', [AdminController::class, 'appointHistory'])->name('appoint-history');
    Route::get('/assignschedule', [AdminController::class, 'assignSchedule']);
    Route::post('/schedule/store', [AdminController::class, 'scheduleStore'])->name('schedule.store');
    Route::get('/view/allcheckups', [AdminController::class, 'viewAllCheckups'])->name('allCheckup');
    Route::get('/checkups', [AdminController::class, 'viewCheckups'])->name('checkups');
    Route::get('/permissions', [AdminController::class, 'showPermissionForm'])->name('permissions.show');
    Route::get('/viewUsers', [AdminController::class, 'viewUsers']);
    Route::post('/assign-roles/{user}', [AdminController::class, 'processAssignRoles'])->name('processAssignRoles');
    Route::get('/adminmaintenance', [AdminController::class, 'maintenance'])->name('viewMaintenance');
    Route::post('/save-maintenance', [MaintenanceController::class, 'save'])->name('save.maintenance');
    Route::get('/new-maintenance', [MaintenanceController::class, 'newMaintenance'])->name('new-maintenance');
    Route::get('/edit-maintenance/{id}', [MaintenanceController::class, 'editMaintenance'])->name('edit-maintenance');
    Route::put('/update-maintenance/{id}', [MaintenanceController::class, 'update'])->name('update-maintenance');
    Route::post('/nurse-schedule', [AdminController::class, 'nurseStore'])->name('nurse-schedule.store');
});

Route::middleware(['auth', 'role:nurse'])->group(function () {

    Route::get('/nurse-dashboard', [AdminController::class, 'nurseDashboard'])->name('nurseModule.dashboard');
    Route::get('/nursePendingAppointments', [AdminController::class, 'viewNursePendingAppointments']);
    Route::get('/available-doctor/{appointmentDate}', [AppointmentController::class, 'getAvailableDoctor'])->name('getAvailableDoctor');
    Route::get('/reGetAvailable-doctor/{appointmentDate}', [AppointmentController::class, 'reGetAvailableDoctor'])->name('reGetAvailableDoctor');
    Route::post('/assign-doctor/{id}', [AppointmentController::class, 'assignDoctor'])->name('appointments.assignDoctor');
    Route::get('/nurse-appointment-history', [AdminController::class, 'nurseAppointHistory'])->name('nurse-appoint-history');
    Route::get('/nurse/allcheckups', [AdminController::class, 'viewNurseAllCheckups'])->name('allNursecheckups');
    Route::get('/nurse/checkups', [AdminController::class, 'viewNurseCheckups'])->name('nurse_checkups');
});

Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor-dashboard', [AdminController::class, 'doctorDashboard'])->name('doctorModule.dashboard');
    Route::get('/doctorCheckupAppointments', [AdminController::class, 'viewDoctorCheckupAppointments'])->name('doctorCheckupAppointments');
    Route::get('/doctor-appointment-history', [AdminController::class, 'doctorAppointHistory'])->name('doctor-appoint-history');
    Route::get('/doctor/checkups', [AdminController::class, 'viewDoctorCheckups'])->name('doctor_checkups');
    Route::get('/doctor/allcheckups', [AdminController::class, 'viewDoctorAllCheckups'])->name('allDoctorcheckups');
});

//----------------------------------------------------------------------------------------------
Route::get('/userlogin', [StudentLoginController::class, 'showLoginForm'])->name('userlogin');
Route::post('/userlogin/login', [StudentLoginController::class, 'login']);
Route::get('/facultylogin', [FacultyLoginController::class, 'showLoginForm'])->name('facultylogin');
Route::post('/facultylogin/login', [FacultyLoginController::class, 'login']);
Route::post('/userlogin/process', [UserController::class, 'process']);
//----------------------------------------------------------------------------------------------





Route::get('/', function () {
    if (Auth::check()) {
        // Get the authenticated user
        $user = Auth::user();

        // Check the user's roles
        if ($user->hasAnyRole('superadmin', 'admin', 'doctor')) {
            // Redirect to admin.dashboard for these roles
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('regular_user')) {
            // Redirect to userdashboard for regular users
            return redirect('/userdashboard');
        } elseif ($user->hasRole('nurse')) {
            // Redirect to userdashboard for regular users
            return redirect('/nurse-dashboard');
        } elseif ($user->hasRole('doctor')) {
            // Redirect to userdashboard for regular users
            return redirect('/doctor-dashboard');
        }
    }

    // Default redirection for guests or users with no roles
    return view('home');
});

Route::post('/register', [RegisterController::class, 'register']);

Route::view("/aboutUs", 'aboutUs');
Route::match(['get', 'post'], '/botman', 'App\Http\Controllers\BotManController@handle');
Route::get('/create', [UserController::class, 'create'])->name('create_account');
Route::get('/frequentlyaskQuestions', [FaqController::class, 'index'])->name('index');


Auth::routes([
    'verify' => true
]);


//Not included in the system
Route::post('/create', [UserController::class, 'store'])->name('user.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
