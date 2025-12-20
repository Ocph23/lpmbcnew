<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarAcademic extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'color',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Aksesors
    public function getFormattedStartTimeAttribute()
    {
        return $this->start_time->format('d M Y H:i');
    }

    public function getFormattedEndTimeAttribute()
    {
        return $this->end_time->format('H:i');
    }

    public function getDayAttribute()
    {
        return $this->start_time->day;
    }

    public function getMonthYearAttribute()
    {
        return $this->start_time->format('F Y');
    }
}
