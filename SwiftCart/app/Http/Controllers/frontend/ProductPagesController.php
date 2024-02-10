<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductPagesController extends Controller
{
    public function get_flash_sale_items()
    {
        $products = Product::whereHas('flash_sale_item', function($query)
        {
            $query->where('status', 1);
        })
        ->where('status', 1)
        ->where('is_approved', 1)
        ->where('quantity', '>', 0)
        ->with(['product_images_gallery', 'product_variants', 'product_variants.product_variant_items', 'category'])
        ->withCount('reviews')
        ->withAvg('reviews', 'rating')
        ->paginate(15);
        $flash_sale = FlashSale::first();
        if (!$flash_sale or $flash_sale->end_date <= now()->toDateString())
        {
            return redirect('/');
        }
        return view('frontend.pages.flash_sale', compact('products'));
    }


    public function get_popular_products()
    {
        $popular_products = Product::where('status', 1)
        ->where('is_approved', 1)
        ->where('quantity', '>', 0)
        ->has('order_products')
        ->withCount('order_products')
        ->with(['product_images_gallery', 'product_variants', 'product_variants.product_variant_items', 'category'])
        ->orderByDesc('order_products_count')
        ->withCount('reviews')
        ->withAvg('reviews', 'rating')
        ->paginate(20);
        return view('frontend.pages.popular_products', compact('popular_products'));
    }
}
