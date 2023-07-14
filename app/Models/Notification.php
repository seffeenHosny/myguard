<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'message'];
    protected $hidden = ['updated_at' , 'created_at'];

    public function user_notifications()
    {
        return $this->hasMany(UserNotification::class);
    }
}
