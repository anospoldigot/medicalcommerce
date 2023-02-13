<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $appends = ['rating', 'real_stock'];

    protected $casts = [
        'status' => 'boolean',
        'is_discount' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function assets()
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class)->latest()->take(4);
    }
    public function getRatingAttribute()
    {
        return number_format($this->reviews()->avg('rating'), 1) ?? 0;
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function getRealStockAttribute()
    {

        if ($this->variantItems()->count() > 0) {
            return $this->variantItems()->sum('item_stock');
        } else {

            return $this->stock;
        }
    }
    public function variantItems()
    {
        return $this->hasMany(ProductVariantValue::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
