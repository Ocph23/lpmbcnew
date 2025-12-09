<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditSchedule extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'schedule_code',
        'audit_name',
        'audit_period',
        'start_date',
        'end_date',
        'status',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relationships
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'draft' => '<span class="badge bg-secondary">Draft</span>',
            'ongoing' => '<span class="badge bg-warning">Ongoing</span>',
            'completed' => '<span class="badge bg-success">Completed</span>',
            default => '<span class="badge bg-light text-dark">' . ucfirst($this->status) . '</span>',
        };
    }

    public function getAuditPeriodLabelAttribute()
    {
        // Optional: convert 'semester_ganjil_2024' → 'Semester Ganjil 2024'
        $parts = explode('_', $this->audit_period);
        if (count($parts) >= 2) {
            $year = array_pop($parts);
            $label = implode(' ', $parts);
            return ucfirst(str_replace('_', ' ', $label)) . ' ' . $year;
        }
        return ucfirst(str_replace('_', ' ', $this->audit_period));
    }
    public function auditTeamMembers()
    {
        return $this->hasMany(AuditTeam::class, 'audit_schedule_id');
    }

    public function auditResults()
    {
        return $this->hasMany(AuditResult::class, 'audit_schedule_id');
    }
}
