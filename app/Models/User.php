<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Shetabit\Visitor\Traits\Visitor;
use Shetabit\Visitor\Traits\Visitable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Visitor, Visitable, LogsActivity;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'referrer_id',
        'referral_token',
        'name',
        'email',
        'password',
        'profile',
        'phone',
        'gender',
        'credit',
        'is_credit_active'
    ];
    protected $appends = ['referral_link'];
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
    ];

    protected static $logAttributes = ['name', 'email', 'password'];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnly(['name', 'email']);
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }


    public function getReferralLinkAttribute()
    {
        return $this->referral_link = route('register', ['ref' => $this->referral_token]);
    }


    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }


    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function default_address()
    {
        return $this->hasOne(Address::class)->where('is_priority', 1);
    }


    public function sender ()
    {
        return $this->hasMany(Message::class, 'from_id', 'id');
    }
    public function receiver ()
    {
        return $this->hasMany(Message::class, 'to_id', 'id');
    }

    public function sender_latest ()
    {
        return $this->hasOne(Message::class, 'from_id', 'id')->latestOfMany();
    }
    
    public function receiver_latest ()
    {
        return $this->hasOne(Message::class, 'to_id', 'id')->latestOfMany();
    }

    public function isCustomer()
    {
        return $this->roles()->where('name', 'customer');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
