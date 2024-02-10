<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\DataTables\BrandDataTable;
use App\Models\Product;
use Exception;
use App\Traits\Image_Handle;

class BrandController extends Controller
{
    use Image_Handle;

    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required' ,'string', 'max:200', 'unique:brands,name'],
            'is_featured' => ['required'],
            'logo' => ['required', 'image', 'max:2048'],
        ]);

        $logo = $this->image_upload($request, 'logo', 'upload');

        Brand::create([
            'name' => ucfirst($request->name),
            'is_featured' => $request->is_featured,
            'status' => $request->status,
            'logo' => $logo,
        ]);

        toastr()->success('Brand Saved Successfully!');

        return redirect()->route('admin.brand.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:200', 'unique:brands,name,'.$id],
            'is_featured' => ['required'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        $logo = $request->logo ? $this->image_update($request, 'logo', 'upload', $brand->logo) : $brand->logo;

        $brand->update([
            'name'=>ucfirst($request->name),
            'status'=>$request->status,
            'is_featured'=>$request->is_featured,
            'logo'=>$logo
        ]);

        toastr()->success('Brand Updated Successfully!');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $product = Product::where('brand_id', $id)->first();
        if ($product)
        {
            return response(['status' => 'error', 'message' => 'You can\'t delete a brand that has products.']);
        }
        $brand = Brand::findOrFail($id);
        $this->delete_image('upload', $brand->logo);
        $brand->delete();
        return response(['status' => 'success', 'message' => 'Brand Deleted Successfully!']);
    }


    /**
     * Change status.
     */

    public function switch_status(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        $brand->update(['status'=>$request->checked]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
    }
}
