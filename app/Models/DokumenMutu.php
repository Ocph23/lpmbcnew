<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DokumenMutu extends Model
{
    //
    use HasFactory;

    protected $table = 'dokumen_mutus'; // sesuai nama tabel

    protected $fillable = [
        'kode',
        'nama',
        'sasaran',
        'unit_id',
        'kategori',
        'jenis_document',
        'document_path',
    ];

    // Akses URL dokumen
    public function getDocumentUrlAttribute()
    {
        return $this->document_path
            ? Storage::url($this->document_path)
            : null;
    }

    // Relasi (asumsikan tabel units)
    public function unit()
    {
        return $this->belongsTo(\App\Models\Unit::class);
    }

    // Opsi dropdown (bisa dipindah ke konstanta)
    public const SASARAN_OPTIONS = ['Internal', 'Eksternal'];
    public const KATEGORI_OPTIONS =
    [
        'Kebijakan SPMI',
        'Manual Mutu',
        'Standar SPMI',
        'Formulir SPMI',
        'Prosedur Mutu',
        'Prosedur Kerja',
        'Standar UPPS/Unit',
        'Borang Akreditasi',
        'Hasil Akreditasi',
        'SK Rektor',
    ];
    public const JENIS_DOCUMENT_OPTIONS = ['Upload', 'Link Eksternal'];
}
