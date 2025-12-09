<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class JadwalAudit extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'auditi_id',
        'periode_id',
        'auditor_id',
        'auditor2_id',
        'start_date',
        'status',
        'document_path',
    ];

    protected $casts = [
        'start_date' => 'date',
    ];

    public function getDocumentUrlAttribute()
    {
        return $this->document_path
            ? Storage::url($this->document_path)
            : null;
    }

    // Relasi
    public function auditi()
    {
        return $this->belongsTo(\App\Models\Auditi::class);
    }

    public function periode()
    {
        return $this->belongsTo(\App\Models\Periode::class);
    }

    public function auditor()
    {
        return $this->belongsTo(\App\Models\User::class, 'auditor_id');
    }

    public function auditor2()
    {
        return $this->belongsTo(\App\Models\User::class, 'auditor2_id');
    }
}
