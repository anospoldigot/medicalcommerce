<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function variant_items()
    {
        return $this->hasMany(ProductVariantItem::class);
    }
}
