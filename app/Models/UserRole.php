<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    protected $casts = [
        'permissions' => 'array', // Automatically converts JSON ↔ PHP array
    ];

    // Prevent reserved role names (optional)
    public static $reservedRoles = ['super_admin', 'guest'];

    // Validation: valid role names
    public static function getAllowedRoleNames()
    {
        return [
            'admin',
            'tim_mutu',
            'auditor',
            'unit_kerja',
            'pimpinan',
        ];
    }


    public function role()
    {
        return $this->hasOne('role_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }
}
