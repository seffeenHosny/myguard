<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $date = ['deleted_at'];
    protected $fillable = ['name_ar' , 'name_en'];
    protected $hidden = ['name_ar' , 'name_en' , 'created_at' , 'updated_at' , 'deleted_at'];
    protected $appends = ['name'];

    public function getNameAttribute(){
        if(app()->isLocale('ar')){
            return $this->name_ar;
        }else{
            return $this->name_en;
        }
    }

    public function districts(){
        return $this->hasMany(District::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function users_cities() {
        return $this->belongsToMany(User::class,'user_cities','city_id','user_id');
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }

}
