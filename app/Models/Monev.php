<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Periode;

class Monev extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'kode_monev',
        'nama_monev',
        'periode_id',
        'status',
        'document_path',
    ];

    // Akses URL dokumen
    public function getDocumentUrlAttribute()
    {
        return $this->document_path
            ? Storage::url($this->document_path)
            : null;
    }

    // Relasi
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
