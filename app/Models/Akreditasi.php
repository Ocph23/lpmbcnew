<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akreditasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'unggul',
        'peringkat_a',
        'baik_sekali',
        'peringkat_baik',
        'peringkat_b',
    ];
}
