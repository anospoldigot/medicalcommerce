<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_sku',
        'item_label',
        'additional_price',
        'item_stock',
        'product_id'
    ];

    public $timestamps = false;
}
