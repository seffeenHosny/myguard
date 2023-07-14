<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalSupport extends Model
{
    use HasFactory;
    protected $fillable = ['phone'];
    protected $hidden = ['created_at' , 'updated_at'];
    
    public function images() :\Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Image::class , 'imageable');
    }
}
