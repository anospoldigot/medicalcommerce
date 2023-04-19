<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $appends = ['encrypt_link'];
    public $timestamps = false;
    public function getEncryptLinkAttribute()
    {
        return Crypt::encryptString($this->link);
    }
}
