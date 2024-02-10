<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantItem extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'status',
        'product_variant_id',
        'is_default',
        'price'
  ];

  public function product_variant()
  {
      return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
  }
}
