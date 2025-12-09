<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTeam extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'audit_schedule_id',
        'auditor_id',
        'role_in_team',
        'assigned_units',
    ];

    protected $casts = [
        'assigned_units' => 'array', // Automatically converts JSON ↔ PHP array
    ];

    // Relationships
    public function auditSchedule()
    {
        return $this->belongsTo(AuditSchedule::class);
    }

    public function auditor()
    {
        return $this->belongsTo(User::class, 'auditor_id');
    }

    // Accessor for role label
    public function getRoleLabelAttribute()
    {
        return match ($this->role_in_team) {
            'ketua' => 'Ketua Tim',
            'anggota' => 'Anggota',
            default => ucfirst($this->role_in_team),
        };
    }

    // Validation rule: assigned_units must be array of unit IDs (optional)
    // Handled in controller
}
