<?php

namespace App\Helpers;

use App\Models\User;
use App\Notifications\ReferrerBonus;

class ReferralHelper
{
    public static function giveBonus ($referral_token)
    {
        $user = User::where('referral_token', $referral_token)->first();
        $dataUpdate = ['credit_active' => '1000'];
        if(!empty($user->is_credit_active)) $dataUpdate['is_credit_active'] = 1;
        $user->update($dataUpdate);
        $user->notify(new ReferrerBonus($user));
    }
    

}
