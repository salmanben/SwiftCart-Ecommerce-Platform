<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckOutController extends Controller
{
    public function index()
    {
        if (Cart::content()->count() == 0)
           return redirect('/');

        $addresses = UserAddress::where('user_id', auth()->user()->id)->get();
        $shipping_methods = ShippingRule::where("status", 1)->get();
        $sub_total = calc_sub_total();
        return view(
            "frontend.pages.checkout",
            compact("addresses", "shipping_methods", "sub_total")
        );
    }


    /* Stock in session shipping method and address */
    public function stock_shipping_info(Request $request)
    {
        $request->validate([
            'address_id'=>'required|integer',
            'shipping_method_id'=>'required|integer',
        ]);

        $shipping_method = ShippingRule::findOrFail($request->shipping_method_id);
        $address = UserAddress::findOrFail($request->address_id);
        session()->put('address', $address);
        session()->put('shipping_method', $shipping_method);
        return redirect()->route('user.payment');

    }
}
