<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JopCondition extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $date = ['deleted_at'];
    protected $fillable = ['condition_ar' , 'condition_en' , 'jop_type_id'];
    protected $hidden = ['condition_ar' , 'condition_en' , 'created_at' , 'updated_at' , 'deleted_at'];
    protected $appends = ['condition'];

    public function getConditionAttribute(){
        if(app()->isLocale('ar')){
            return $this->condition_ar;
        }else{
            return $this->condition_en;
        }
    }

    public function jop_type(){
        return $this->belongsTo(JopType::class)->withTrashed();
    }
}
