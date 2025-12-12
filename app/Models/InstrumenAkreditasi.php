<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class InstrumenAkreditasi extends Model
{
    //
    use HasFactory;

    protected $table = 'instrumen_akreditasis'; // sesuai nama tabel

    protected $fillable = [
        'kode',
        'nama',
        'sasaran',
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

    // Opsi dropdown (bisa dipindah ke konstanta)
    public const SASARAN_OPTIONS = ['Internal', 'Public'];
    public const JENIS_DOCUMENT_OPTIONS = ['Upload', 'Link Eksternal'];
}
