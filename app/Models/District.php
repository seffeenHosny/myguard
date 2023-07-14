<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $date = ['deleted_at'];
    protected $fillable = ['name_ar' , 'name_en' , 'city_id'];
    protected $hidden = ['name_ar' , 'name_en' , 'created_at' , 'updated_at' , 'deleted_at'];
    protected $appends = ['name'];

    public function getNameAttribute(){
        if(app()->isLocale('ar')){
            return $this->name_ar;
        }else{
            return $this->name_en;
        }
    }

    public function city(){
        return $this->belongsTo(City::class)->withTrashed();
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }
}
