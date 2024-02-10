<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Models\Banner;

class ProductFilterController extends Controller
{
    public function index(Request $request)
    {

        if (($request->has('sub_category') && !$request->has('category')) || ($request->has('child_category') && !$request->has('sub_category'))) {
            abort(404);
        }
        if (count($request->all()) == 0) {
            $products = Product::where('quantity', '>', 0)->where('status', 1)->where('is_approved', 1)->paginate(10);
        } else {
            $cat_id = $sub_cat_id = $child_cat_id = '';
            if ($request->has('category') && $request->category != 'all') {
                $cat_id = Category::where('name', $request->category)->firstOrFail()->id;

                if ($request->has('sub_category')) {

                    $sub_cat_id = SubCategory::where('name', $request->sub_category)
                        ->where('category_id', $cat_id)
                        ->firstOrFail()->id;

                    if ($request->has('child_category')) {
                        $child_cat_id = ChildCategory::where('name', $request->child_category)
                            ->where('category_id', $cat_id)
                            ->where('sub_category_id', $sub_cat_id)
                            ->firstOrFail()->id;
                    }
                }

            }


            $products = Product::where('status', 1)
                ->where('is_approved', 1)
                ->where('quantity', '>', 0)
                ->when($request->has('category'), function ($query) use ($cat_id, $request, $sub_cat_id, $child_cat_id) {
                    if ($request->category == 'all')
                        return $query;
                    else {
                        return  $query->where('category_id', $cat_id)
                            ->when($request->has('sub_category'), function ($query) use ($request, $sub_cat_id, $child_cat_id) {
                                return $query->where('sub_category_id', $sub_cat_id)
                                    ->when($request->has('child_category'), function ($query) use ($child_cat_id) {
                                        return  $query->where('child_category_id', $child_cat_id);
                                    });
                            });
                    }
                })
                ->when($request->has('search'), function ($query) use ($request) {
                    $query->where(function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%')
                            ->orWhere('short_description', 'like', '%' . $request->search . '%')
                            ->orWhere('long_description', 'like', '%' . $request->search . '%');
                    });
                })
                ->when($request->has('brand'), function ($query) use ($request) {
                    return $query->whereHas('brand', function($query) use ($request)
                    {
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
                ->with(['reviews', 'product_images_gallery', 'product_variants'])
                ->withCount('reviews')
                ->withAvg('reviews', 'rating')
                ->paginate(20);
        }

        $product_filter_banner = Banner::where('key', 'product_filter_banner')->first();
        $product_filter_banner = json_decode(@$product_filter_banner->value);
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('frontend.pages.product_filter', compact('products', 'categories', 'brands', 'product_filter_banner'));
    }
}
