<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsentForm extends Model
{
    use HasFactory;
    protected $table = 'consent_form';
    protected $fillable = [
        'name',
        'email',
        'gender',
        'user_type',
        'age',
        'guardian',
        'guardian_relation',
        'phone',
        'consent_agreement',
    ];
    
   
    // // Define the property for appointment_id
    // protected $appointment_id;

    // // Define the property for appointment_date
    // protected $appointment_date;

    public function appointment()
{
    return $this->hasOne(Appointment::class, 'consent_id');
}

    public function getAppointmentId()
    {
        return $this->appointment_id;
    }

    // Setter method for appointment_id
    public function setAppointmentId($appointmentId)
    {
        $this->appointment_id = $appointmentId;
    }

    // Getter method for appointment_date
    public function getAppointmentDate()
    {
        return $this->appointment_date;
    }

    // Setter method for appointment_date
    public function setAppointmentDate($appointmentDate)
    {
        $this->appointment_date = $appointmentDate;
    }
}
