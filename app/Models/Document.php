<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_code',
        'title',
        'description',
        'file_path',
        'file_size',
        'mime_type',
        'document_type',
        'unit_id',
        'uploaded_by',
        'validity_date',
        'status',
        'standard_id',
        'version',
        'previous_version_id',
    ];

    protected $casts = [
        'validity_date' => 'date',
        'file_size' => 'integer',
        'version' => 'integer',
    ];

    // Relationships
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function standard()
    {
        return $this->belongsTo(Standar::class);
    }

    public function previousVersion()
    {
        return $this->belongsTo(Document::class, 'previous_version_id');
    }

    public function nextVersions()
    {
        return $this->hasMany(Document::class, 'previous_version_id');
    }

    // Accessor for human-readable type
    public function getDocumentTypeLabelAttribute()
    {
        return match ($this->document_type) {
            'kebijakan' => 'Kebijakan',
            'sop' => 'SOP',
            'formulir' => 'Formulir',
            'bukti' => 'Bukti',
            default => ucfirst($this->document_type),
        };
    }

    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'draft' => '<span class="badge bg-warning">Draft</span>',
            'approved' => '<span class="badge bg-success">Approved</span>',
            'expired' => '<span class="badge bg-danger">Expired</span>',
            default => '<span class="badge bg-secondary">' . ucfirst($this->status) . '</span>',
        };
    }
}
