<?php

namespace App\Http\Controllers\frontend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\FlashSaleItem;
use App\Models\HomeSetting;
use App\Models\OrderProduct;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('order')->get();

        $flash_sale_items = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->pluck('product_id')->toArray();

        $home_setting = HomeSetting::all();
        $top_categories = $home_setting->where('key', 'top_categories')->first();
        if ($top_categories) {
            $top_categories = $top_categories->value;
            $top_categories = json_decode($top_categories);
        } else
            $top_categories = [];
        $top_categories = Category::whereIn('id', $top_categories)->get();
        $single_categories = $home_setting->where('key', 'single_categories')->first();
        if ($single_categories) {
            $single_categories = $single_categories->value;
            $single_categories = json_decode($single_categories);
        } else
            $single_categories = [];
        $single_categories = Category::whereIn('id', $single_categories)->get();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
        $popular_products = Product::where('status', 1)
        ->where('is_approved', 1)
        ->where('quantity', '>', 0)
        ->has('order_products')
        ->withCount('order_products')
        ->with(['product_images_gallery', 'product_variants', 'product_variants.product_variant_items', 'category'])
        ->orderByDesc('order_products_count')
        ->withCount('reviews')
        ->withAvg('reviews', 'rating')
        ->limit(10)
        ->get();



        /* banners */

        $home_banners = Banner::all();

        $home_banner_section_one = $home_banners->where('key', 'home_banner_section_one')->first();
        $home_banner_section_one = json_decode(@$home_banner_section_one->value);
        $home_banner_section_two = $home_banners->where('key', 'home_banner_section_two')->first();
        $home_banner_section_two = json_decode(@$home_banner_section_two->value);
        $home_banner_section_three = $home_banners->where('key', 'home_banner_section_three')->first();
        $home_banner_section_three = json_decode(@$home_banner_section_three->value);
        $home_banner_section_four = $home_banners->where('key', 'home_banner_section_four')->first();
        $home_banner_section_four = json_decode(@$home_banner_section_four->value);
        $home_banner_section_five = $home_banners->where('key', 'home_banner_section_five')->first();
        $home_banner_section_five = json_decode(@$home_banner_section_five->value);
        return view('frontend.home.index', compact('sliders', 'flash_sale_items', 'top_categories', 'single_categories', 'brands', 'popular_products', 'home_banner_section_one', 'home_banner_section_two', 'home_banner_section_three', 'home_banner_section_four', 'home_banner_section_five'));
    }
}
