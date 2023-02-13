<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function post ()
    {
        return $this->belongsTo(Post::class, 'category_id', 'id');
    }
}
