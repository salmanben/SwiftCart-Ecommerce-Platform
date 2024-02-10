<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\GeneralSetting;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\StripeSetting;
use App\Models\Transaction;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function index()
    {
        if (!session()->has('address') || !session()->has('shipping_method'))
            return redirect('/');
        $stripe_settings = StripeSetting::first();
        $paypal_settings = PaypalSetting::first();
        return view('frontend.pages.payment', compact('stripe_settings', 'paypal_settings'));
    }

    public function paypal_config()
    {
        $paypal_settings = PaypalSetting::findOrFail(1);

        $config = [
            'mode'    => $paypal_settings->mode,
            'sandbox' => [
                'client_id'         => $paypal_settings->client_id,
                'client_secret'     => $paypal_settings->secret_key,
                'app_id'            => '',
            ],

            'live' => [
                'client_id'         => $paypal_settings->client_id,
                'client_secret'     => $paypal_settings->secret_key,
                'app_id'            => '',
            ],

            'payment_action' => 'Sale',
            'currency'       => $paypal_settings->currency_name,
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];
        return $config;
    }

    public function payer_paypal()
    {
        if (!session()->get('shipping_method')) {
            toastr()->error('Something went wrong, try again!');
            return redirect()->route('home');
        }
        $paypal_settings = PaypalSetting::findOrFail(1);
        $config = $this->paypal_config();
        $provider = new PayPalClient($config);
        $provider->setApiCredentials($config);
        $provider->getAccessToken();
        $total = round(calc_sub_total() - get_discount_coupon() + intval(session()->get('shipping_method')['cost']), 2);
        $totalPayer = round($total * $paypal_settings->currency_rate, 2);
        $cart_content = Cart::content();
        $arr_id = [];
        foreach ($cart_content as $item) {
            $arr_id[] = $item->id;
        }
        $products_cart = Product::whereIn('id', $arr_id)->get();
        foreach ($products_cart as $product) {
            if ($product->status == 0 ||  $product->quantity < $cart_content->where('id', $product->id)->first()->qty) {
                $rowId = $cart_content->where('id', $product->id)->first()->rowId;
                $cart_content->forget($rowId);
                toastr()->error('Unavailable product! Please try again.');
                return redirect()->route('cart_view');
            }
        }


        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route("user.paypal.success"),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $totalPayer
                    ],
                    'description' => ''
                ]
            ],
        ]);

        foreach ($order['links'] as $item) {
            if ($item['rel'] == 'approve') {
                return redirect()->away($item['href']);
            }
        }
        toastr()->error('Something went wrong, try again!');
        return redirect()->route('user.payment');
    }

    public function success_paypal(Request $request)
    {
        $config = $this->paypal_config();
        $provider = new PayPalClient($config);
        $provider->setApiCredentials($config);
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        $paypal_settings = PaypalSetting::findOrFail(1);

        if (isset($response['status']) &&  $response['status'] == 'COMPLETED') {
            $this->store_transaction('paypal', $paypal_settings->currency_rate,  $response['id'], $paypal_settings->currency_icon);
            if (session()->get('coupon')) {
                $coupon = Coupon::find(session('coupon')['id']);
                $coupon->update([
                    'total_use' => $coupon->total_use + 1
                ]);
            }
            session()->forget('coupon');
            session()->forget('shipping_method');
            session()->forget('addresss');
            $items = Cart::content();
            foreach ($items as $item) {
                $product = Product::findOrFail($item->id);
                $product->update([
                    'quantity' => $product->quantity - $item->qty
                ]);
            }
            Cart::destroy();
            toastr()->success('Payment Successed');
            return redirect('/');
        } else {
            toastr()->error('Something went wrong, try again!');
            return redirect()->route('user.payment');
        }
    }

    public function payer_stripe(Request $request)
    {
        if (!session()->get('shipping_method')) {
            toastr()->error('Something went wrong, try again!');
            return redirect()->route('home');
        }

        $stripe_settings = StripeSetting::firstOrFail();
        Stripe::setApiKey($stripe_settings->secret_key);
        $total =  round(calc_sub_total() - get_discount_coupon() + intval(session()->get('shipping_method')['cost']), 2);
        $amount = round($total * $stripe_settings->currency_rate, 2);
        $cart_content = Cart::content();
        $arr_id = [];
        foreach ($cart_content as $item) {
            $arr_id[] = $item->id;
        }
        $products_cart = Product::whereIn('id', $arr_id)->get();
        foreach ($products_cart as $product) {
            if ($product->status == 0 ||  $product->quantity < $cart_content->where('id', $product->id)->first()->qty) {
                $rowId = $cart_content->where('id', $product->id)->first()->rowId;
                $cart_content->forget($rowId);
                toastr()->error('Unavailable product! Please try again.');
                return redirect()->route('cart_view');
            }
        }
        $charge = Charge::create([

            'amount' => $amount * 100, // Amount in cents
            'currency' => $stripe_settings->currency_name, // Change to your desired currency
            'source' => $request->stripe_token, // Stripe token obtained from the client-side
            "description" => "product purchase!"
        ]);

        if ($charge->status == 'succeeded') {
            $this->store_transaction('stripe',  $stripe_settings->currency_rate, $charge->id, $stripe_settings->currency_icon);
            $items = Cart::content();
            foreach ($items as $item) {
                $product = Product::findOrFail($item->id);
                $product->update([
                    'quantity' => $product->quantity - $item->qty
                ]);
            }
            if (session()->get('coupon')) {
                $coupon = Coupon::find(session('coupon')['id']);
                $coupon->update([
                    'total_use' => $coupon->total_use + 1
                ]);
            }
            session()->forget('coupon');
            session()->forget('shipping_method');
            session()->forget('addresss');
            Cart::destroy();
            toastr()->success('Payment Successed');
            return redirect('/');
        } else {
            toastr()->error('Something went wrong, try again!');
            return redirect()->route('user.payment');
        }
    }

    public function store_transaction($payment_method, $currency_rate, $transaction_id, $currency_icon)
    {
        $total = round(calc_sub_total() - get_discount_coupon() + intval(session()->get('shipping_method')['cost']), 2);
        $setting = GeneralSetting::first();
        $order = Order::create([
            'invoice_id' => rand(1, 90000),
            'user_id' => auth()->user()->id,
            'amount' => $total,
            'sub_total' => calc_sub_total(),
            'count_products' => Cart::content()->count(),
            'currency_icon' => $setting->currency_icon,
            'order_address' => json_encode(session()->get('address')),
            'shipping_method' => json_encode(session()->get('shipping_method')),
            'payment_method' => $payment_method,
            'coupon' => json_encode(session()->get('coupon')),
            'order_status' => 'pending',
        ]);

        foreach (Cart::content() as $product) {
            OrderProduct::create([
                'order_id' => $order->id,
                'status'=>'pending',
                'qty' => $product->qty,
                'product_id' => $product->id,
                'order_product_price' => $product->price,
                'variants' => json_encode($product->options->variants),
                'variant_total' => $product->options->total_variants,
            ]);
        }
        $totalPayer = round($total * $currency_rate, 2);
        Transaction::create([
            'order_id' => $order->id,
            'transaction_id' => $transaction_id,
            'payment_method' => $payment_method,
            'amount_real_currency' => $totalPayer,
            'currency_icon' => $currency_icon,
        ]);
    }
}
