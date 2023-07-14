<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = ['day_ar' , 'day_en'];
    protected $hidden = ['day_ar' , 'day_en' , 'created_at' , 'updated_at'];
    protected $appends = ['day'];

    public function getDayAttribute(){
        if(app()->isLocale('ar')){
            return $this->day_ar;
        }else{
            return $this->day_en;
        }
    }

    public function jobs(){
        return $this->belongsToMany(Job::class);
    }
}
