<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ProductVariantDataTable;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductVariantController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantDataTable $dataTable)
    {

        $product = Product::findOrFail($request->id);

        return $dataTable->render('admin.product.product_variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $id = $product->id;
        return view('admin.product.product_variant.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
                'name'=>'required|string|max:255',
            ]);
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
        return view('admin.product.product_variant.edit', compact('product_variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
                'name'=>'required|string|max:255',
            ]);

        $product_variant = ProductVariant::findOrFail($id);
        $product_variant->update(
            [
                'name'=>ucfirst($request->name),
                'status'=>$request->status,
                'product_id'=>$request->product_id
            ]
            );
            toastr()->success('Product Variant Updated Successfully!');
            return redirect()->route('admin.product_variant.index', ['id'=>$request->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $product_variant = ProductVariant::findOrFail($id);
        $product_variant->delete();
        return response(['status'=>'success', 'message'=>'Product Variant Deleted Successfully!']);

    }

    /**
     * Change status.
     */

     public function switch_status(Request $request)
     {
        $product_variant = ProductVariant::findOrFail($request->id);
        $product_variant->update(['status'=>$request->checked]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
     }
}
