<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    public $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];


    public function users()
    {
        return $this->hasMany(User::class);
    }
}
