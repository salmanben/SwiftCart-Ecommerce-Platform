<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSaleItem extends Model
{
    use HasFactory;
    public $fillable = [
        'product_id',
        'status',
        'show_at_home',
        'flash_sale_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function flash_sale()
    {
        return $this->belongsTo(FlashSale::class);
    }
}
