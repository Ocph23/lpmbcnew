<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amilink extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'instrumenami',
        'dokumenhasilami',
        'link1',
        'link2',
        'link3',
    ];
}
