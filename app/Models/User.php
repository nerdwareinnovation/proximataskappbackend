<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'facebook_id',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

//    public function roles()
//    {
//        return $this->belongsTo('App\Role');
//    }

    public function picture()
    {
        return $this->hasOne('App\Models\Astrology\Picture');
    }
    public function package(){
        return $this->hasOne('App\Models\Astrology\CustomerPackage','customer_id','id');
    }

//    public function details()
//    {
//        return $this->hasOne('App\Models\Astrology\CustomerDetails');
//    }
    public function astrologerDetails()
    {
        return $this->hasOne('App\Models\Astrology\AstrologerDetails');
    }
    public function psychologistDetails()
    {
        return $this->hasOne('App\Models\Astrology\PsychologistDetails');
    }
    public function moderatorDetails()
    {
        return $this->hasOne('App\Models\Astrology\ModeratorDetails');
    }

    public function customerPackage()
    {
        return $this->hasOne('App\Models\Astrology\CustomerPackage','customer_id');
    }

    public function moderator()
    {
        return $this->hasOne('App\Models\User');
    }
    public function queries(){
        return $this->hasMany('App\Models\Astrology\Chat','sender_id','id');
    }
}
