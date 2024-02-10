<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ProductDataTable;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Traits\Image_Handle;


class ProductController extends Controller
{
    use Image_Handle;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $datatable)
    {
        return $datatable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('admin.product.create', compact('categories' ,'brands'));
    }

    /**
     * Get Sub Categories
     */
    public function get_sub_categories(Request $request)
    {

        $category = Category::findOrFail($request->id);
        $sub_categories = $category->sub_categories()->where('status', 1)->get();;
        return response($sub_categories);
    }

    /**
     * Get Child Categories
     */
    public function get_child_categories(Request $request)
    {
        $sub_category = SubCategory::findOrFail($request->id);
        $child_categories = $sub_category->child_categories()->where('status', 1)->get();;
        return response($child_categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'required|image|max:2048',
            'video_link' => 'nullable|url',
            'sku' => 'nullable|string',
            'quantity' => 'required|integer',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric',
            'category' => 'required',
            'sub_category' => 'nullable',
            'child_category' => 'nullable',
            'offer_start_date' => 'nullable|before:offer_end_date|after_or_equal:' . now()->toDateString(),
            'offer_end_date' => 'nullable|after:offer_start_date|after:' . now()->toDateString(),

        ]);
        $image = $this->image_upload($request, 'image', 'upload');

        $max_check = 1;
        while (true) {
            if ($max_check == 10) {
                $latest_id = Product::max('id');
                $slug = $request->name . '_' . (intval($latest_id) + 1);
            } else {
                $slug = $request->name . '_' . uniqid();
            }

            $check = Product::where('slug', $slug)->first();
            if (!$check) {
                break;
            }
            $max_check++;
        }

        Product::create(
            [
                'name' => ucfirst($request->name),
                'slug' => $slug,
                'image' => $image,
                'video_link' => $request->video_link,
                'sku' => $request->sku,
                'quantity' => $request->quantity,
                'short_description' => ucfirst($request->short_description),
                'long_description' => ucfirst($request->long_description),
                'price' => $request->price,
                'offer_price' => $request->offer_price,
                'offer_start_date' => $request->offer_start_date,
                'offer_end_date' => $request->offer_end_date,
                'vendor_id' => auth()->user()->vendor->id,
                'brand_id' => $request->brand,
                'category_id' => $request->category,
                'sub_category_id' => $request->sub_category,
                'child_category_id' => $request->child_category,
                'product_type' => $request->product_type,
                'is_approved' => 1,
                'status' => $request->status,
            ]
            );

            toastr()->success('Product Created Successfully!');
            return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $sub_categories = SubCategory::where('category_id', $product->category_id)->get();
        $child_categories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        return view('admin.product.edit', compact('product', 'brands', 'categories', 'sub_categories', 'child_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'nullable|image|max:2048',
            'video_link' => 'nullable|url',
            'sku' => 'nullable|string',
            'quantity' => 'required|integer',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric',
            'category' => 'required',
            'sub_category' => 'nullable',
            'child_category' => 'nullable',
            'offer_start_date' => 'nullable|before:offer_end_date|after_or_equal:' . now()->toDateString(),
            'offer_end_date' => 'nullable|after:offer_start_date|after:' . now()->toDateString(),
        ]);

        $product = Product::findOrFail($id);

        $image = $request->image ?  $this->image_update($request, 'image', 'upload', $product->image) : $product->image;

        $max_check = 1;
        while (true) {
            if ($max_check == 10) {
                $latest_id = Product::max('id');
                $slug = $request->name . '_' . (intval($latest_id) + 1);
            } else {
                $slug = $request->name . '_' . uniqid();
            }

            $check = Product::where('slug', $slug)->where('id','!=',$id)->first();
            if (!$check) {
                break;
            }
            $max_check++;
        }

        $product->update(
            [
                'name' => ucfirst($request->name),
                'slug' => $slug,
                'image' => $image,
                'video_link' => $request->video_link,
                'sku' => $request->sku,
                'quantity' => $request->quantity,
                'short_description' => ucfirst($request->short_description),
                'long_description' => ucfirst($request->long_description),
                'price' => $request->price,
                'offer_price' => $request->offer_price,
                'offer_start_date' => $request->offer_start_date,
                'offer_end_date' => $request->offer_end_date,
                'brand_id' => $request->brand,
                'category_id' => $request->category,
                'sub_category_id' => $request->sub_category,
                'child_category_id' => $request->child_category,
                'product_type' => $request->product_type,
                'status' => $request->status,
            ]
            );

            toastr()->success('Product Updated Successfully!');
            return redirect()->route('admin.product.index');
    }

    /**

     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->order_products != null && $product->order_products->count() > 0)
            return response(['status'=>'error', 'message'=>'You can\'t delete this product, you must delete all orders including this product first.']);
        $this->delete_image('upload', $product->image);
        foreach($product->product_images_gallery as $row)
        {
            $this->delete_image('upload', $row->image);
        }
        $product->delete();
        return response(['status'=>'success', 'message'=>'Product Deleted Successfully!']);
    }


    /**
     * Change status.
     */

     public function switch_status(Request $request)
     {
        $product = Product::findOrFail($request->id);
        $product->update(['status'=>$request->checked]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
     }

}
