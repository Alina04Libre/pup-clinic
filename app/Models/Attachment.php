<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'attachments';

    protected $fillable = ['filename', 'path', 'mime_type', 'size', 'appointment_id'];


    public function appointments()
    {
        return $this->belongsToMany(Appointment::class);
    }
}
