<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyPackage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $date = ['deleted_at'];
    protected $fillable =   [
                                'title_ar' ,
                                'title_en' ,
                                'description_ar' ,
                                'description_en' ,
                                'no_of_days' ,
                                'price' ,
                                'no_of_cvs' ,
                                'type'
                            ];

    protected $hidden = ['title_ar' , 'title_en' , 'description_ar' , 'description_en' , 'created_at' , 'updated_at' , 'deleted_at'];
    protected $appends = ['title' , 'description' ];

    public function getTitleAttribute(){
        if(app()->isLocale('ar')){
            return $this->title_ar;
        }else{
            return $this->title_en;
        }
    }

    public function getDescriptionAttribute(){
        if(app()->isLocale('ar')){
            return $this->description_ar;
        }else{
            return $this->description_en;
        }
    }

    public function subscribe_company_packages(){
        return $this->hasMany(SubscribeCompanyPackage::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
