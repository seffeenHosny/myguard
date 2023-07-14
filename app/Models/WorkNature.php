<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkNature extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $date = ['deleted_at'];
    protected $fillable = ['nature_ar' , 'nature_en'];
    protected $hidden = ['nature_ar' , 'nature_en' , 'created_at' , 'updated_at' , 'deleted_at'];
    protected $appends = ['nature'];

    public function getNatureAttribute(){
        if(app()->isLocale('ar')){
            return $this->nature_ar;
        }else{
            return $this->nature_en;
        }
    }

    public function jobs(){
        return $this->hasMany(Job::class)->withTrashed();
    }
}
