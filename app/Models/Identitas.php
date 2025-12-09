<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'visimisi',
        'sejarah',
        'deskripsilpm',
        'struktur_organisasi_path',
    ];
}
