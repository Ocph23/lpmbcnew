<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function headOfUnits()
    {
        return $this->hasMany(\App\Models\Unit::class, 'head_user_id');
    }

    // In User.php
    public function uploadedDocuments()
    {
        return $this->hasMany(Document::class, 'uploaded_by');
    }

    public function createdAuditSchedules()
    {
        return $this->hasMany(AuditSchedule::class, 'created_by');
    }
    public function auditAssignments()
    {
        return $this->hasMany(AuditTeam::class, 'auditor_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function assignRole($roleName)
    {

        $role = Role::where('role_name', $roleName)->first();

        if (!$role) {
            throw new \Exception("Role '$roleName' tidak ditemukan.");
        }

        // Tambahkan ke tabel pivot user_role
        UserRole::create([
            'user_id' => $this->id,
            'role_id' => $role->id
        ]);
    }
}
