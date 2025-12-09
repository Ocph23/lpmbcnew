<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_code',
        'unit_name',
        'unit_type',
        'parent_unit_id',
        'head_user_id',
    ];

    // Relationships
    public function parent()
    {
        return $this->belongsTo(Unit::class, 'parent_unit_id');
    }

    public function children()
    {
        return $this->hasMany(Unit::class, 'parent_unit_id');
    }

    public function head()
    {
        return $this->belongsTo(User::class, 'head_user_at');
    }

    // Fix: should be 'head_user_id'
    public function headUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'head_user_id');
    }

    // Accessor for readable type
    public function getUnitTypeLabelAttribute()
    {
        return match ($this->unit_type) {
            'fakultas' => 'Fakultas',
            'prodi' => 'Program Studi',
            'bureau' => 'Biro',
            'lab' => 'Laboratorium',
            default => ucfirst($this->unit_type),
        };
    }
    //

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
