<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\VendorProductImageGalleryDataTable;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Traits\Image_Handle;

class ProductImageGalleryController extends Controller
{
    use Image_Handle;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductImageGalleryDataTable $dataTable)
    {
        $product = Product::findOrFail($request->id);
        if ($product->vendor_id != auth()->user()->vendor->id)
           abort(404);
        return $dataTable->render('admin.product.image_gallery.index', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'images.*'=>['required', 'image', 'max:2048']
            ],
            [
                'images.*.image'=>'All the selected files must be images.',
            ]
            );
            $images = $this->multiple_image_upload($request, 'images', 'upload');
            foreach($images as $image)
            {
                ProductImageGallery::create([
                    'image'=>$image,
                    'product_id'=>$request->product_id
                ]);
            }

            toastr()->success('Images Uploaded Successfully!');
            return redirect()->back();

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_image_gallery = ProductImageGallery::findOrFail($id);
        if ($product_image_gallery->product->vendor_id != auth()->user()->vendor->id)
           abort(404);
        $this->delete_image('upload', $product_image_gallery->image);
        $product_image_gallery->delete();
        return response(['status'=>'success', 'message'=>'Image Deleted Successfully!']);
    }
}
