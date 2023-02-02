<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    // Created By
    public function from ()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function to ()
    {
        return $this->belongsTo(User::class);
    }
}
