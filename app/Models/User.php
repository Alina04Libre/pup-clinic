<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Appointment;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Course;
use App\Models\Department;
use App\Notifications\VerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'middle_name',
        'last_name',
        'user_category_id',
        'year_level',
        'student_id',
        'course_id',
        'department_id',
        'email',
        'age',
        'sex',
        'civil_tatus',
        'phone_number',
        'address',
        'password',
        'birth_month',
        'birth_day',
        'birth_year',
        'user_type_id',
        'contact_person_number',
        'contact_person',
        'is_medical_record_complete',
        'email_verified_at',
        'profile_photo_path',
    ];

    public $medicalStatus;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**public function userCategory()
    {
        return $this->belongsTo(UserCategory::class);
    }*/

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function nurseAssignment()
    {
        return $this->hasMany(ScheduleAssignment::class, 'nurse_id');
    }

    public function doctorAssignment()
    {
        return $this->hasMany(ScheduleAssignment::class, 'doctor_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function scheduleAssignments()
    {
        return $this->hasMany(ScheduleAssignment::class);
    }

    public function doctorSchedule()
    {
        return $this->hasMany(ScheduleAssignment::class, 'doctor_id', 'id');
    }

    public function getMessageCount(){ 
        if(auth()->check()){
            $count = ChMessage::where('to_id', auth()->id())->where('seen', '0')->count();
            return $count;
    }
    return 0;
    }

    public function nurseSchedule()
    {
        return $this->hasMany(ScheduleAssignment::class, 'nurse_id', 'id');
    }



    public function hasDoctorScheduleBetween3To5()
    {
        $today = now()->toDateString();

        return $this->doctorSchedule()
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->whereTime('start_time', '>=', '15:00:00')
            ->whereTime('end_time', '<=', '17:00:00')
            ->exists();
    }

    public function hasNurseScheduleBetween3To5()
    {
        $today = now()->toDateString();

        return $this->nurseSchedule()
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->whereTime('start_time', '>=', '15:00:00')
            ->whereTime('end_time', '<=', '17:00:00')
            ->exists();
    }


    public function medicalRecords()
    {
        return $this->hasOne(MedicalRecord::class);
    }
    public function yearLevel()
    {
        return $this->belongsTo(YearLevel::class, 'year_level');
    }
    public function userCategory()
    {
        return $this->belongsTo(UserCategory::class, 'user_category_id');
    }
    public function strand()
    {
        return $this->belongsTo(Strand::class, 'strand_id');
    }
    // public function schoolYear()
    // {
    //     return $this->belongsTo(SchoolYear::class, 'school_year_id');
    // }
    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }

    // Relationship with walk-in checkups (one-to-many)
    public function walkInCheckups()
    {
        return $this->hasMany(WalkInCheckup::class);
    }

    protected $with = ['doctorSchedule', 'nurseSchedule'];
}
