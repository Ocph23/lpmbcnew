<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditResult extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'audit_schedule_id',
        'unit_id',
        'audit_instrument_id',
        'score',
        'evidence_note',
        'document_evidence_id',
        'filled_by',
        'verified_by',
        'verification_status',
        'verification_note',
        'verified_at',
    ];

    protected $casts = [
        'score' => 'float',
        'verified_at' => 'datetime',
    ];

    // Relationships
    public function auditSchedule()
    {
        return $this->belongsTo(AuditSchedule::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function audit_instrument()
    {
        return $this->belongsTo(AuditInstrument::class);
    }

    public function documentEvidence()
    {
        return $this->belongsTo(Document::class, 'document_evidence_id');
    }

    public function filledBy()
    {
        return $this->belongsTo(User::class, 'filled_by');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Accessor for verification badge
    public function getVerificationStatusBadgeAttribute()
    {
        return match ($this->verification_status) {
            'pending' => '<span class="badge bg-warning">Pending</span>',
            'verified' => '<span class="badge bg-success">Verified</span>',
            'rejected' => '<span class="badge bg-danger">Rejected</span>',
            default => '<span class="badge bg-secondary">' . ucfirst($this->verification_status) . '</span>',
        };
    }

    // Scope: only pending results
    public function scopePending($query)
    {
        return $query->where('verification_status', 'pending');
    }
}
