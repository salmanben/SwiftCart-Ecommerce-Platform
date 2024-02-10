<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {

        $paypal_settings = PaypalSetting::first();
        $stripe_settings = StripeSetting::first();
        return view('admin.payment.settings', compact('paypal_settings', 'stripe_settings'));
    }

    public function update_paypal_setting(Request $request)
    {
        session()->put('gateway', 'paypal');
        $request->validate([
            'client_id' => 'required|string',
            'secret_key' => 'required|string',
            'mode' => 'required|in:sandbox,live',
            'country_name' => 'required',
            'currency_icon' => 'required',
            'currency_name' => 'required|string|max:255',
            'currency_rate' => 'required|numeric',

        ]);

        PaypalSetting::updateOrCreate(
            ['id' => 1],
            $request->except('_token')
        );
        toastr()->success('Settings Saved Successfully');
        return redirect()->back();
    }

    public function update_stripe_setting(Request $request)
    {
        session()->put('gateway', 'stripe');
        $request->validate([
            'stripe_client_id' => 'required|string',
            'stripe_secret_key' => 'required|string',
            'stripe_mode' => 'required|in:sandbox,live',
            'stripe_country_name' => 'required|string',
            'stripe_currency_icon' => 'required|string',
            'stripe_currency_rate' => 'required|numeric',
            'stripe_currency_name' => 'required|string|max:255',
            'stripe_status'=>'required'

        ]);
        
        StripeSetting::updateOrCreate(
            ['id' => 1],
            [
                'client_id' => $request->stripe_client_id,
                'secret_key' => $request->stripe_secret_key,
                'mode' => $request->stripe_mode,
                'country_name' => $request->stripe_country_name,
                'currency_icon' => $request->stripe_currency_icon,
                'currency_name' => $request->stripe_currency_name,
                'currency_rate' => $request->stripe_currency_rate,
                'status' => $request->stripe_status,
            ]);
        toastr()->success('Settings Saved Successfully');
        return redirect()->back();
    }
}
