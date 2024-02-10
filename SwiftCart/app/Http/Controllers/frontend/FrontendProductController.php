<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariantItem;
use App\Models\Review;

class FrontendProductController extends Controller
{
    public function show($id)
    {

        $product = Product::where('status', 1)->where('is_approved', 1)->where('quantity','>', 0)->with([
            'product_variants' => function ($query) {
                $query->with(['product_variant_items'=>function ($query) {
                    $query->where('status', 1);
                }])->where('status', 1);
            },
           'reviews', 'brand'
        ])
        ->withCount('reviews')
        ->withAvg('reviews', 'rating')
        ->findOrFail($id);
        return view('frontend.pages.product_detail', compact('product'));
    }



      public function get_price(Request $request)
    {
        $variant_items_id = $request->variant_items_id;
        $product = Product::findOrFail($request->id);
        $initial_price = has_discount($product) ? $product->offer_price : $product->price;
        $price = $initial_price;
        foreach($variant_items_id as $item_id)
        {
            $extra_charge = ProductVariantItem::findOrFail($item_id)->price;
            $price = $price + $extra_charge;
        }
        return response(['price'=>$price * $request->qty]);

    }

}
