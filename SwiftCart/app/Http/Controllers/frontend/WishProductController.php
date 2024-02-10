<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\WishProduct;
use Illuminate\Http\Request;

class WishProductController extends Controller
{
    public function index()
    {
        $wish_products = WishProduct::where('user_id', auth()->user()->id)->with(['product', 'user'])->get();
        if (count($wish_products) == 0)
           return redirect('/');
        return view('frontend.pages.wish_product', compact('wish_products'));
    }

    public function store(Request $request)
    {
        if (!$request->product_id)
            abort(404);
        $already_added = false;
        $wish_product = WishProduct::where('product_id', $request->product_id)
        ->where('user_id', auth()->user()->id)->get();
        if (count($wish_product) == 0)
            WishProduct::create(
            [
                'product_id'=>$request->product_id,
                'user_id'=>auth()->user()->id

            ]
            );
        else
            $already_added = true;
        return response(['status'=>'success', 'already_added'=>$already_added]);
    }

    public function remove(Request $request)
    {
        $wish_product = WishProduct::findOrFail($request->id);
        $wish_product->delete();
        return response(['status'=>'success']);
    }

    public function  destroy()
    {
        WishProduct::truncate();
        return response(['status'=>'success']);
    }
}
