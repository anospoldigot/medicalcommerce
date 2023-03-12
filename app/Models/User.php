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
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Visitor, Visitable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
        'phone',
        'gender',
        'credit',
        'is_credit_active'
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
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
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
}
