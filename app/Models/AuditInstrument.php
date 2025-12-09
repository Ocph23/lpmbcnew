<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditInstrument extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'instrument_code',
        'question_text',
        'standar_id',
        'weight',
        'evidence_type',
        'is_active',
    ];

    protected $casts = [
        'weight' => 'float',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function standar()
    {
        return $this->belongsTo(Standar::class);
    }

    // Accessors
    public function getEvidenceTypeLabelAttribute()
    {
        return match ($this->evidence_type) {
            'dokumen' => 'Dokumen',
            'observasi' => 'Observasi',
            'wawancara' => 'Wawancara',
            default => ucfirst($this->evidence_type),
        };
    }

    public function getStatusBadgeAttribute()
    {
        return $this->is_active
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-secondary">Inactive</span>';
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
