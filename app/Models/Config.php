<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];
    
    public $appends = [
        'is_shippable', 
        'can_shipping', 
        'is_tripay_ready',
        'is_telegram_ready',
        'courier_available', 
        'is_bank_ready',
        'is_demo_mode',
        'is_mail_ready'
        ];

    protected $hidden = [
        'rajaongkir_apikey',
        'tripay_api_key',
        'tripay_private_key',
        'tripay_merchant_code',
        'telegram_bot_token',
        'telegram_user_id',
    ];

    public $casts = [
        'is_notifypro' => 'boolean',
        'is_payment_gateway' => 'boolean',
        'is_whatsapp_checkout' => 'boolean',
        'is_guest_checkout' => 'boolean',
        'cod_list' => 'array'
    ];


    public function getIsShippableAttribute()
    {
        return $this->rajaongkir_apikey && $this->rajaongkir_type ? true : false;
    }
    public function getCanShippingAttribute()
    {
        return $this->rajaongkir_apikey && $this->rajaongkir_type && $this->warehouse_id && $this->rajaongkir_couriers ? true : false;
    }
    public function getIsTripayReadyAttribute()
    {
        return $this->tripay_api_key && $this->tripay_private_key && $this->tripay_merchant_code && $this->is_payment_gateway ? true : false;
    }
    public function getIsTelegramReadyAttribute()
    {
        return $this->telegram_bot_token && $this->telegram_user_id ? true : false;
    }
    public function getIsMailReadyAttribute()
    {
        $mail = config('mail.mailers.smtp');
        if($mail['username'] && $mail['host'] && $mail['port'] && $mail['encryption'] && $mail['password']) {
            return true;
        }
        return false;
    }
    public function getIsBankReadyAttribute()
    {
        if(BankAccount::count() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getCourierAvailableAttribute()
    {
        return [
            'pro' => config('rajaongkir.courier_pro'),
            'basic' => config('rajaongkir.courier_basic'),
            'starter' => config('rajaongkir.courier_starter')
        ];
    }
    public function getIsDemoModeAttribute()
    {
        return env('IS_DEMO_MODE', false);
    }

    public function address ()
    {
        return $this->belongsTo(Address::class);
    }
}
