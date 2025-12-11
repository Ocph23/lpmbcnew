<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenAkreditasi extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'auditi_id',
        'lembaga_akreditasi',
        'jenjang',
        'peringkat',
        'tanggal_sk',
        'tanggal_mulai',
        'tanggal_berakhir',
        'link_sk',
        'link_sertifikat',
    ];

    protected $casts = [
        'tanggal_sk' => 'date',
        'tanggal_mulai' => 'date',
        'tanggal_berakhir' => 'date',
    ];

    // Relasi
    public function auditi()
    {
        return $this->belongsTo(\App\Models\Auditi::class);
    }

    // Opsi dropdown (bisa dipindah ke konstanta)
    public const LEMBAGA_OPTIONS = ['BAN-PT', 'LAM-PTKes', 'LAMDIK', 'LAINNYA'];
    public const JENJANG_OPTIONS = ['Profesi', 'D3', 'D4', 'S1', 'S2', 'S3'];
    public const PERINGKAT_OPTIONS = ['Unggul', 'A', 'Baik Sekali', 'Baik', 'B', 'Terakreditasi Sementara', 'Tidak Memenuhi Syarat'];
}
