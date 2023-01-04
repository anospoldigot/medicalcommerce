<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function assets()
    {
        return $this->morphMany(Asset::class, 'assetable');
    }

    public $appends = [
        'image_url',
        'created_locale'
    ];

    public $casts = [
        'is_listing' => 'boolean',
        'is_promote' => 'boolean'
    ];

    public function scopeListing()
    {
        return $this->where('is_listing', 1);
    }
    public function scopePromote()
    {
        return $this->where('is_promote', 1);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? config('app.url') . '/upload/images/' . $this->image : '';
    }

    public function getCreatedLocaleAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('d F Y');
    }
}
