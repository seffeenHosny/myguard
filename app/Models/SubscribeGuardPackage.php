<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribeGuardPackage extends Model
{
    use HasFactory;
    protected $fillable =   [
        'user_id' ,
        'guard_package_id' ,
        'status',
        'price',
        'tax',
        'total_price'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function guard_package(){
        return $this->belongsTo(GuardPackage::class)->withTrashed();
    }
}
