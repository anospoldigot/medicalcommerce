<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'variant_item_label',
    ];
    public $timestamps = false;

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
    public function variant_item_values()
    {
        return $this->hasMany(ProductVariantValue::class);
    }
}
