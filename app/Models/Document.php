<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode',
        'nama',
        'kategori',
        'sasaran',
        'jenis_document',
        'document_path',
    ];
}
