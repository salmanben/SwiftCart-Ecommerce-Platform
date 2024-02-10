<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use App\Models\Banner;
use App\Models\Order;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {

        $variants_items = [];
        $product = Product::findOrFail($request->id);

        $price = has_discount($product) ? $product->offer_price : $product->price;
        $total_variants = 0;

        if ($request->variants_items) {
            for ($i = 0; $i < count($request->variants_items); $i++) {
                if ($request->variants_items[$i]) {
                    $variant_item = ProductVariantItem::findOrFail($request->variants_items[$i]);
                    $variants_items[$variant_item->product_variant->name] = $variant_item->name;
                    $total_variants += $variant_item->price;
                }
            }
        } else {
            foreach ($product->product_variants as $product_variant) {
                if ($product_variant->status) {
                    foreach ($product_variant->product_variant_items as $product_variant_item)
                        if ($product_variant_item->status && $product_variant_item->is_default) {
                            $total_variants += $product_variant_item->price;
                            $variants_items[$product_variant->name] = $product_variant_item->name;
                        }
                }
            }
        }
        $old_rowId = null;
        foreach (Cart::content() as $item) {
            if ($item->id == $request->id) {
                $old_rowId = $item->rowId;
                Cart::remove($item->rowId);

                break;
            }
        }

        $added_product = Cart::add([
            'id' => $request->id, 'name' => $product->name, 'qty' => $request->qty, 'weight' => 10, 'price' => $price,
            'options' => [
                'variants' => $variants_items,
                'image' => $product->image,
                'total_variants' => $total_variants,
                'variants_items' => $variants_items
            ]
        ]);
        $data = [
            'rowId' => $added_product->rowId,
            'price' => $price,
            'image' => $product->image,
            'name' => $product->name,
            'id' => $request->id,
            'qty' => $request->qty,
            'total_variants' => $total_variants,
            'sub_total' => calc_sub_total(),
            'old_rowId' => $old_rowId

        ];
        return response([
            'status' => 'success', 'message' => 'Product Added To Cart Successfully!',
            'item' => $data
        ]);
    }

    public function cart_view()
    {
        $cart_content = Cart::content();
        if ($cart_content->count() == 0) {
            return redirect('/');
        }
        $cart_view_banner = Banner::where('key', 'cart_view_banner')->first();
        $cart_view_banner = json_decode(@$cart_view_banner->value);
        return view('frontend.pages.cart_view', compact('cart_content', 'cart_view_banner'));
    }

    public function cart_destroy()
    {
        Cart::destroy();
        session()->forget('coupon');
        return response(['status' => 'success', 'message' => 'Cart Cleared Successfully!']);
    }


    public function cart_remove(Request $request)
    {

        Cart::remove($request->rowId);
        if (Cart::content()->count() == 0)
            session()->forget('coupon');
        return response(['status' => 'success', 'message' => 'Cart item removed Successfully!',
        'sub_total' => calc_sub_total(),
        'discount_value' => get_discount_coupon()]);
    }


    public function cart_update(Request $request, String $rowId)
    {

        Cart::update($rowId, $request->qty);
        return response(['sub_total' => calc_sub_total(),  'discount_value' => get_discount_coupon()]);
    }


    /* Apply Coupon */
    public function apply_coupon(Request $request)
    {
        if (session()->has('coupon') && session()->get('coupon')['code'] == $request->code)
            return response()->json([
                'status' => 'success',
                'sub_total' => calc_sub_total(),
                'discount_value' => get_discount_coupon()
            ]);

        session()->forget('coupon');
        $coupon = Coupon::where([
            'code' => $request->code,
            'status' => 1,
        ])->whereColumn('quantity', '>', 'total_use')
            ->where('start_date', '<=', date('Y-m-d'))
            ->first();
        if (!$coupon) {
            return response()->json(['status' => 'error', 'message' => 'Invalid Coupon Code!']);
        }

        if ($coupon->end_date < date('Y-m-d')) {
            return response()->json(['status' => 'error', 'message' => 'Coupon Expired!']);
        }

        $orders = Order::where('coupon', '!=', "null")->where('user_id', auth()->user()->id)->get();
        $count_used = 0;
        for($i = 0; $i < count($orders); $i++)
        {
            $used_coupon = json_decode($orders[$i]['coupon']);
            if($used_coupon->code == $request->code)
            {
                $count_used++;
            }
        }
        if($count_used >= $coupon['max_use'])
        {
            return response()->json(['status' => 'error', 'message' => 'You can\'t use this coupon anymore!']);
        }
        if (session()->has('coupon') && session()->get('coupon')['code'] != $request->code) {
            session()->forget('coupon');
        }

        session()->put('coupon', [
            'id' => $coupon->id,
            'name' => $coupon->name,
            'code' => $coupon->code,
            'discount_type' => $coupon->discount_type,
            'discount' => $coupon->discount
        ]);

        return response()->json([
            'status' => 'success',
            'sub_total' => calc_sub_total(),
            'discount_value' => get_discount_coupon()
        ]);
    }
}
