<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $fillable = [
        'user_id',
        'consent_id',
        'name',
        'email',
        'phone_number',
        'concern',
        'appointment_date',
        'appointment_time',
        'remark',
        'status',
        'unique_id', // Add unique_id to allow mass-assignment
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
        'appointment_time' => 'datetime',
        'new_appointment_date' => 'datetime',
        'new_appointment_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function branch()
    // {
    //     return $this->belongsTo(Branch::class);
    // }
    public function consentForm()
    {
        return $this->hasOne(ConsentForm::class);
    }
    public function consent()
    {
        return $this->belongsTo(ConsentForm::class, 'consent_id');
    }
    public function nurse()
    {
        return $this->belongsTo(User::class, 'nurse_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
    public function checkup()
    {
        return $this->hasOne(Checkup::class);
    }

    public function attachments()
    {
        return $this->belongsToMany(Attachment::class);
    }

    // public function getDynamicStatusAttribute()
    // {
    //     if (!$this->nurse && !$this->doctor && $this->appointment_date < now()) {
    //         return 'Expired';
    //     }

    //     // Add more conditions as needed

    //     // Default status if none of the conditions are met
    //     return $this->status;
    // }

    public function getDynamicStatus()
    {
        // $this refers to the current instance of Appointment

        //For Pending Appointemnts
        if ($this->status === "Pending" && !$this->nurse && !$this->doctor) {
            $appointmentEndOfDay = $this->appointment_date->endOfDay();
        
            // Check if the end of the appointment day is in the past
            if (now() > $appointmentEndOfDay) {
                return 'Expired';
            }
        }

        //For Approved Appointemnts
        if ($this->status === "Approved" && $this->nurse && !$this->doctor)  {
            $appointmentEndOfDay = $this->appointment_date->endOfDay();

            if (now() > $appointmentEndOfDay) {
                return 'Expired';
            }
        }

        //For For Checkup Appointemnts
        if ($this->status === "For Checkup" && $this->nurse && $this->doctor) {
            $appointmentEndOfDay = $this->appointment_date->endOfDay();

            if (now() > $appointmentEndOfDay) {
                return 'Expired';
            }
        }

        //For Re-Scheduled Appointemnts
        if ($this->status === "Re-Scheduled" &&  $this->reason_for_resched && !$this->nurse && !$this->doctor) {

            $appointmentEndOfDay = $this->new_appointment_date->endOfDay();

            if (now() > $appointmentEndOfDay) {
                return 'Expired';
            }
        }

        //For Re-Scheduled - Approved Appointemnts
        if ($this->status === "Approved" && $this->reason_for_resched && $this->nurse && !$this->doctor) {

            $appointmentEndOfDay = $this->new_appointment_date->endOfDay();

            if (now() > $appointmentEndOfDay) {
                return 'Expired';
            }
        }

        //For Re-Scheduled - For Checkup Appointemnts
        if ($this->status === "For Checkup" && $this->reason_for_resched && $this->nurse && $this->doctor) {

            $appointmentEndOfDay = $this->new_appointment_date->endOfDay();

            if (now() > $appointmentEndOfDay) {
                return 'Expired';
            }
        }

        // Add more conditions as needed

        // Default status if none of the conditions are met
        return $this->status;
    }
}
