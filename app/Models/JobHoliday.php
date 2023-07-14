<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobHoliday extends Model
{
    use HasFactory;

    protected $fillable = ['holiday_id' , 'job_id'];
}
