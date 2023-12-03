<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['assets'];
    public $appends = ['rating', 'real_stock', 'real_price', 'discount_amount'];

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
        return $this->hasMany(Review::class);
    }

    public function latest_reviews()
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

    public function getRealPriceAttribute()
    {

        if ($this->is_discount > 0) {
            if ($this->discount_type == 'persen') {
                return ($this->price / 100) * $this->discount;
            } else {
                return $this->price - $this->discount;
            }
        }

        return $this->price;
    }

    public function getDiscountAmountAttribute()
    {
        $price = 0;

        if ($this->is_discount > 0) {
            $price = $this->price;
            if ($this->discount_type == 'persen') {
                $price = ($this->price / 100) * $this->discount;
            } else if ($this->discount_type == 'nominal') {
                $price = $this->price - $this->discount;
            }
        }

        return $price;
    }


    public function variantItems()
    {
        return $this->hasMany(ProductVariantValue::class);
    }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}
