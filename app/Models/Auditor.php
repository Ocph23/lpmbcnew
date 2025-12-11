<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'kategori',
    ];

    // Opsi kategori (misal: 1 = Internal, 2 = Eksternal)
    public const KATEGORI_OPTIONS = [
        1 => 'Auditor 1',
        2 => 'Auditor 2',
    ];

    // Akses nama kategori
    public function getKategoriLabelAttribute()
    {
        return self::KATEGORI_OPTIONS[$this->kategori] ?? 'Tidak Diketahui';
    }
}
