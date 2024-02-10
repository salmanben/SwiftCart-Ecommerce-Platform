<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\VendorProductVariantDataTable;
use App\Models\Product;
use App\Models\ProductVariant;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductVariantDataTable $dataTable)
    {

        $product = Product::findOrFail($request->id);
        if ($product->vendor_id != auth()->user()->vendor->id)
            abort(404);
        return $dataTable->render('vendor.product.product_variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if ($product->vendor_id != auth()->user()->vendor->id)
            abort(404);
        $id = $product->id;
        return view('vendor.product.product_variant.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
                'name'=>'required|string|max:255',
            ]);
        $product = Product::findOrFail($request->product_id);
        ProductVariant::create(
            [
                'name'=>ucfirst($request->name),
                'status'=>$request->status,
                'product_id'=>$request->product_id
            ]
            );
            toastr()->success('Product Variant Created Successfully!');
            return redirect()->back();

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product_variant = ProductVariant::findOrFail($id);
        if ($product_variant->product->vendor_id != auth()->user()->vendor->id)
           abort(404);
        return view('vendor.product.product_variant.edit', compact('product_variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
                'name'=>'required|string|max:255',
            ]);

        $product = Product::findOrFail($request->product_id);
        if ($product->vendor_id != auth()->user()->vendor->id)
           abort(404);
        $product_variant = ProductVariant::findOrFail($id);
        $product_variant->update(
            [
                'name'=>ucfirst($request->name),
                'status'=>$request->status,
                'product_id'=>$request->product_id
            ]
            );
            toastr()->success('Product Variant Updated Successfully!');
            return redirect()->route('vendor.product_variant.index', ['id'=>$request->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $product_variant = ProductVariant::findOrFail($id);
        if ($product_variant->product->vendor_id != auth()->user()->vendor->id)
           abort(404);
        $product_variant->delete();
        return response(['status'=>'success', 'message'=>'Product Variant Deleted Successfully!']);

    }

    /**
     * Change status.
     */

     public function switch_status(Request $request)
     {
        $product_variant = ProductVariant::findOrFail($request->id);
        if ($product_variant->product->vendor_id != auth()->user()->vendor->id)
            abort(404);
        $product_variant->update(['status'=>$request->checked]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
     }
}
