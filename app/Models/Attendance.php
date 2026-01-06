<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';

    protected $fillable = [
        'user_id',
        'calendar_date',
        'clock_in',
        'clock_out',
    ];

    public $timestamps = false;
}
