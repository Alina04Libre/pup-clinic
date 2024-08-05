<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Checkup extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'appointment_id',
        'prescription',
        'disposition',
        'diagnosis',
        'documents',
    ];

    // Define the relationship with the Appointment model
    public function appointment()
    {
        return $this->belongsTo(Appointment::class)->withDefault(); // withDefault sets the relationship to a new instance if it's null
    }

}
