<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_size',
        'mime_type',
        'document_type',
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    // Optional: human-readable document type
    public function getDocumentTypeLabelAttribute()
    {
        return match ($this->document_type) {
            'spmi' => 'SPMI',
            'spme' => 'SMPE',
            'pusatdata' => 'Pusat Data',
            default => ucfirst($this->document_type),
        };
    }
}
