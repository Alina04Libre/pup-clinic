<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearLevel extends Model
{
    use HasFactory;
    protected $table = 'year_level';
    
    protected $fillable = ['name'];

    
}
