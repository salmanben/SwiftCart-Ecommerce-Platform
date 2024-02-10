<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorShopController extends Controller
{
    public function index(Request $request)
    {

        $vendor = Vendor::findOrFail($request->vendor_id);
        $cat_id = '';
        if ($request->has('category') && $request->category != 'all') {
            $cat_id = Category::where('name', $request->category)->firstOrFail()->id;
        }


        $products = Product::
            where('vendor_id', $request->vendor_id)
            ->where('status', 1)
            ->where('is_approved', 1)
            ->where('quantity', '>', 0)
            ->when($request->has('category'), function ($query) use ($cat_id, $request) {
                if ($request->category == 'all')
                    return $query;
                else
                    return  $query->where('category_id', $cat_id);

                })
            ->when($request->has('brand'), function ($query) use ($request) {
                return $query->whereHas('brand', function ($query) use ($request) {
                    $query->whereIn('name', $request->brand);
                });
            })
            ->when($request->has('size'), function ($query) use ($request) {
                return $query->whereHas('product_variants', function ($query) use ($request) {
                    $query->where('name', 'size')->where('status', 1)->whereHas('product_variant_items', function ($query) use ($request) {
                        $query->where('status', 1)->whereIn('name', $request->size);
                    });
                });
            })
            ->when($request->has('color'), function ($query) use ($request) {
                return $query->whereHas('product_variants', function ($query) use ($request) {
                    $query->where('name', 'color')->where('status', 1)->whereHas('product_variant_items', function ($query) use ($request) {
                        $query->where('status', 1)->whereIn('name', $request->color);
                    });
                });
            })
            ->when($request->has('from_price') && $request->from_price != '', function ($query) use ($request) {
                return $query->where('price', '>=', $request->from_price);
            })
            ->when($request->has('to_price') && $request->to_price != '', function ($query) use ($request) {
                return $query->where('price', '<=', $request->to_price);
            })
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->with(['product_images_gallery', 'product_variants', 'product_variants.product_variant_items', 'category'])
            ->paginate(20);


        $product_filter_banner = Banner::where('key', 'product_filter_banner')->firstOrFail();
        $product_filter_banner = json_decode(@$product_filter_banner->value);
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $shop_name = Vendor::where('id', $request->vendor_id)->firstOrFail()->shop_name;
        $vendor_id = $request->vendor_id;
        return view('frontend.pages.store', compact('products', 'categories', 'brands', 'product_filter_banner', 'shop_name', 'vendor_id'));
    }
}
