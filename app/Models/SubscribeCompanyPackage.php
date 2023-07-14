<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribeCompanyPackage extends Model
{
    use HasFactory;
    protected $fillable =   [
        'user_id' ,
        'company_package_id' ,
        'status' ,
        'rest_of_points',
        'price',
        'tax',
        'total_price'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company_package(){
        return $this->belongsTo(CompanyPackage::class)->withTrashed();
    }
}
