<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\ReferrerBonus;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class UserObserver
{
    public function created(User $user)
    {
        if ($user->referrer !== null) {
        }
        
        // Notification::send($user->referrer, new ReferrerBonus($user));
        // if($user->hasRole('customer')){
        //     $user->update(['referral_token' => generateReferralCode()]);
        // }
    }
}
