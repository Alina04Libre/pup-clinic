<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleAssignment extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'nurse_id',
        'satellite',
        'status',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
    ];

    protected $dates = ['start_date', 'end_date'];
    
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function nurse()
    {
        return $this->belongsTo(User::class, 'nurse_id');
    }

}

