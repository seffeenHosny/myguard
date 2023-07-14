<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $hidden = ['updated_at'];
    protected $fillable =   [
                                'conversation_id' ,
                                'message' ,
                                'type',
                            ];
                            
    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }

}
