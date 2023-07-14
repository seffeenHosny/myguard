<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $date = ['deleted_at'];
    protected $fillable =   [
                                'user_id' ,
                                'jop_type_id',
                                'city_id' ,
                                'district_id' ,
                                'salary' ,
                                'no_of_days' ,
                                'no_of_hours' ,
                                'last_date_to_accept' ,
                                'work_nature_text',
                                'holiday',
                                'work_nature_id'
                            ];
    protected $hidden = ['updated_at' , 'deleted_at'];

    public function city(){
        return $this->belongsTo(City::class)->withTrashed();
    }

    public function district(){
        return $this->belongsTo(District::class)->withTrashed();
    }

    public function company(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function holidays(){
        return $this->belongsToMany(Holiday::class , 'job_holidays');
    }

    public function job_users(){
        return $this->hasMany(JobUser::class);
    }

    public function jop_type(){
        return $this->belongsTo(JopType::class)->withTrashed();
    }

    public function work_nature(){
        return $this->belongsTo(WorkNature::class)->withTrashed();
    }

}
