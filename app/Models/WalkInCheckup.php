<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalkInCheckup extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'prescription',
        'complaint',
        'diagnosis',
        'documents',
        'doctor_id', 
        'nurse_id', 
        'patient_id',
        'time',
        'date',
    ];
    // Relationship with user (many-to-one)
    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function nurse()
    {
        return $this->belongsTo(User::class, 'nurse_id');
    }
}
