<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditi extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'head_id',
    ];

    // Relasi: Auditi dimiliki oleh satu User (sebagai head)
    public function head()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
