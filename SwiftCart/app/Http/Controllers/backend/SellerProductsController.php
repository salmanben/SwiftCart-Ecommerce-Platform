<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\SellerProductsDataTable;
use App\Models\Product;

class SellerProductsController extends Controller
{

    /**
     * Get Sellers Products
     */
    public function get_seller_products(SellerProductsDataTable $datatable)
    {
        return $datatable->render('admin.product.seller_product.index');
    }

    /**
     * Change approve.
     */

     public function switch_approve(Request $request)
     {

        Product::find($request->id)->update(['is_approved'=>$request->selected]);
        return response(['status'=>'success', 'message'=>'Approved State Changed Successfully!']);

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
