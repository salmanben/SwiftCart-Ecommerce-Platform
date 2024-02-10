<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'video_link',
        'sku',
        'quantity',
        'short_description',
        'long_description',
        'price',
        'offer_price',
        'offer_start_date',
        'offer_end_date',
        'vendor_id',
        'brand_id',
        'category_id',
        'sub_category_id',
        'child_category_id',
        'product_type',
        'is_approved',
        'status',
    ];


    public function product_images_gallery()
    {
        return $this->hasMany(ProductImageGallery::class, 'product_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function flash_sale_item()
    {
        return $this->hasOne(FlashSaleItem::class);
    }
    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
