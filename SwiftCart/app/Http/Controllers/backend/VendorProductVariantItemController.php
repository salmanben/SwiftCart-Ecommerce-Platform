<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\VendorProductVariantItemDataTable;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;


class VendorProductVariantItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductVariantItemDataTable $datatable)
    {

        $product_variant = ProductVariant::findOrFail($request->variant_id);
        if ($product_variant ->product->vendor_id != auth()->user()->vendor->id)
            abort(404);
        return $datatable
        ->render('vendor.product.product_variant.product_variant_item.index', compact('product_variant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product_variant = ProductVariant::findOrFail($request->variant_id);
        if ($product_variant->product->vendor_id != auth()->user()->vendor->id)
            abort(404);
        return view('vendor.product.product_variant.product_variant_item.create', compact('product_variant'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'item_name'=>'required|string|max:255',
            'price'=>'required|numeric',
            'is_default'=>'required'
        ]);
        if ($request->is_default == 1 && $request->price != 0)
        {
            toastr()->error('The default variant item must have the price 0!');
            return redirect()->back();
        }
        $product_variant = ProductVariant::findOrFail($request->product_variant_id);
        if ($product_variant->product->vendor_id != auth()->user()->vendor->id)
            abort(404);
        ProductVariantItem::create([
            'name'=>ucfirst($request->item_name),
            'price'=>$request->price,
            'is_default'=>$request->is_default,
            'status'=>$request->status,
            'product_variant_id'=>$request->product_variant_id
        ]);
        toastr()->success('Product Variant Item Created Successfully!');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $product_variant_item = ProductVariantItem::findOrFail($id);
        if ($product_variant_item->product_variant->product->vendor_id != auth()->user()->vendor->id)
            abort(404);
        return view('vendor.product.product_variant.product_variant_item.edit', compact('product_variant_item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $variant_id)
    {

        $request->validate([
            'item_name'=>'required|string|max:255',
            'price'=>'required|numeric',
            'is_default'=>'required'
        ]);
        if ($request->is_default == 1 && $request->price != 0)
        {
            toastr()->error('The default variant item must have the price 0!');
            return redirect()->back();
        }
        $product_variant_item = ProductVariantItem::findOrFail($variant_id);
        if ($product_variant_item ->product_variant ->product->vendor_id != auth()->user()->vendor->id)
            abort(404);
        $product_variant_item->update([
            'name'=>ucfirst($request->item_name),
            'price'=>$request->price,
            'is_default'=>$request->is_default,
            'status'=>$request->status,
            'product_variant_id'=>$request->product_variant_id
        ]);
        toastr()->success('Product Variant Item Updated Successfully!');
        return redirect()->route('vendor.product_variant_item.index',['variant_id'=>$request->product_variant_id]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $variant_id)
    {

        $product_variant_item = ProductVariantItem::findOrFail($variant_id);
        if ($product_variant_item ->product_variant ->product->vendor_id != auth()->user()->vendor->id)
            abort(404);

        $product_variant_item->delete();
        return response(['status'=>'success', 'message'=>'Product Variant Item Deleted Successfully!']);

    }

    /**
     * Change Status
     */
    public function switch_status(Request $request)
    {
        $product_variant_item = ProductVariantItem::findOrFail($request->id);
        if ($product_variant_item ->product_variant ->product->vendor_id != auth()->user()->vendor->id)
            abort(404);
        $product_variant_item->update(['status'=>$request->checked]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
    }
}
