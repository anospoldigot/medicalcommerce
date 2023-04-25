<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ReferrerBonus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyUserWhenRefSuccess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user;

    public function __construct($ref)
    {
        
        $this->user = User::where('referral_token', $ref)->first();
    }

    public function handle()
    {
        $this->user->notify(new ReferrerBonus($this->user));
    }
}
