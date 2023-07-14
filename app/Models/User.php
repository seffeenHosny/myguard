<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'verify_phone',
        'verify_email',
        'code',
        'type',
        'image',
        'block',
        'online_status',
        'dark_mode',
        'no_experience',
        'military_experience',
        'experience_of_the_filed_of_security',
        'lang',
        'commercial_registration_no',
        'commercial_registration_image',
        'identification_id',
        'iban_no',
        'qualification',
        'fcm_token',
        'age',
        'experience',
        'gender',
        'social_status',
        'company_type_id',
        'jop_type_id',
        'city_id',
        'district_id',
        'offer_me',
        'appear',
        'communication',
        'other_cities',
        'english'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function company_type(){
        return $this->belongsTo(CompanyType::class)->withTrashed();
    }

    public function jop_type(){
        return $this->belongsTo(JopType::class)->withTrashed();
    }

    public function city(){
        return $this->belongsTo(City::class)->withTrashed();
    }

    public function district(){
        return $this->belongsTo(District::class)->withTrashed();
    }

    public function user_notifications(){
        return $this->hasMany(UserNotification::class);
    }

    public function cities(){
        return $this->belongsToMany(City::class , 'user_cities','user_id','city_id')->withTrashed();
    }

    public function subscribe_company_packages(){
        return $this->hasMany(SubscribeCompanyPackage::class);
    }

    public function subscribe_guard_packages(){
        return $this->hasMany(SubscribeGuardPackage::class);
    }

    public function company_jobs(){
        return $this->hasMany(Job::class , 'user_id', 'id' );
    }

    public function job_users(){
        return $this->hasMany(JobUser::class);
    }

    public function conversations(){
        return $this->hasMany(Conversation::class);
    }

    public function guard_conversations(){
        return $this->belongsToMany(Conversation::class , 'conversation_users' , 'id' , 'user_id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function guard_companies(){
        return $this->hasMany(CompanyGuard::class , 'id' , 'company_id');
    }

    public function company_guards(){
        return $this->hasMany(CompanyGuard::class  , 'company_id' , 'id');
    }

    public function contact_us(){
        return $this->hasMany(ContactUs::class);
    }
}
