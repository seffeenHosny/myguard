<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
    protected $fillable = ['contact_reason_id' ,'user_id', 'message' , 'file' , 'type'];

    public function contact_reason(){
        return $this->belongsTo(ContactReason::class)->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
