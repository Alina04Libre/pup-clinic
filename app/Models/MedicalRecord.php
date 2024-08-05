<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;
    protected $table = 'medical_records';

    protected $fillable = [
        'user_id',
        'name',
        'strand',
        'course',
        'year_level',
        'department',
        'address',
        'contact_number',
        'age',
        'gender',
        'civil_status',
        'contact_person',
        'is_pwd',
        // 'blood_type',
        'contactPerson_number',
        'childhood_illness',
        'previous_hospitalization',
        'operation_surgery',
        'current_medications',
        'allergies',
        'family_history',
        'history_cigarette',
        'history_alcohol',
        'history_travel',
        'vital_signs',
        'height',
        'weight',
        'bmi',
        'bp',
        'hr',
        'rr',
        'temp',
        'head',
        'eyes',
        'ears',
        'throat',
        'chest',
        'x_ray',
        'breast',
        'murmur',
        'rhythm',
        'abdomen',
        'geneto_urinary',
        'extremities',
        'vertebral_column',
        'skin',
        'scars',
        'working_impression',
        'fit',
        'work_up',
        'referred_to',
        'followUp',
        'physician_name',
        'remarks',
        'is_medical_record_complete',
    ];
    protected $casts = [
        'childhood_illness' => 'array',
        'family_history' => 'array',
        'head' => 'array',
        'eyes' => 'array',
        'ears' => 'array',
        'throat' => 'array',
        'chest' => 'array',
        'vertebral_column' => 'array',
        'skin' => 'array',
        'referred_to' => 'array',
        // Add other fields that should be cast as arrays here
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
