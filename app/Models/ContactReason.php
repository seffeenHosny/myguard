<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactReason extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $date = ['deleted_at'];
    protected $fillable = ['reason_en' , 'reason_ar'];
    protected $hidden = ['reason_en' , 'reason_ar' , 'created_at' , 'updated_at' , 'deleted_at'];
    protected $appends = ['reason'];

    public function getReasonAttribute(){
        if(app()->isLocale('ar')){
            return $this->reason_ar;
        }else{
            return $this->reason_en;
        }
    }

    public function contact_us(){
        return $this->hasMany(ContactUs::class);
    }
}
