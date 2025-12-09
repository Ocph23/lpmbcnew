<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standar extends Model
{
    use HasFactory;

    protected $fillable = [
        'standar_code',
        'standar_name',
        'description',
        'category',
        'weight',
    ];


    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function auditInstruments()
    {
        return $this->hasMany(AuditInstrument::class, 'standar_id');
    }
}
