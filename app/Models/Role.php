<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Role extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'role_name',
        'permissions',
    ];

    protected $casts = [
        'permissions' => 'array', // Automatically converts JSON ↔ PHP array
    ];

    // Prevent reserved role names (optional)
    public static $reservedRoles = ['super_admin', 'guest'];

    // Validation: valid role names
    public static function getAllowedRoleNames()
    {

        $roles = Role::all();
        $data = [];

        foreach ($roles as $key => $value) {
            $data[] = $value->role_name;
        }

        return $data;
        // return [
        //     'admin',
        //     'tim_mutu',
        //     'auditor',
        //     'unit_kerja',
        //     'pimpinan',
        // ];
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    }
}
