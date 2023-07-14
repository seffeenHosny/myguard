<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['description_ar' , 'description_en' , 'main_image'];
    protected $hidden = ['description_ar' , 'description_en' , 'updated_at'];
    protected $appends = ['description'];

    public function getDescriptionAttribute(){
        if(app()->isLocale('ar')){
            return $this->description_ar;
        }else{
            return $this->description_en;
        }
    }

    public function images() :\Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Image::class , 'imageable');
    }
}
