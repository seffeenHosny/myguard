<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyGuard extends Model
{
    use HasFactory;
    protected $fillable = ['company_id' , 'guard_id' , 'the_number_of_days_left'];

    public function company(){
        return $this->belongsTo(User::class , 'company_id' , 'id');
    }

    public function company_guard(){
        return $this->belongsTo(User::class , 'guard_id' , 'id');
    }
}
