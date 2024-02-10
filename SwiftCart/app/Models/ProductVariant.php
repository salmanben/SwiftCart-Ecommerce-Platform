<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    public $fillable = [
          'name',
          'status',
          'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function product_variant_items()
    {
        return $this->hasMany(ProductVariantItem::class);
    }
}
