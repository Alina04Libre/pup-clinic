<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
class UserType extends Model
{
    use HasFactory;

    protected $table = 'user_types';
    public function users()
    {
        return $this->hasMany(User::class, 'user_type_id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user_type', 'user_type_id', 'role_id');
    }
    
}
