<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'written_by', 'body',];
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
