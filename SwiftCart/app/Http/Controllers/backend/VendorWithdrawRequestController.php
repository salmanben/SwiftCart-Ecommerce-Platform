<?php

namespace App\Http\Controllers\backend;

use App\DataTables\VendorWithdrawRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\WithdrawMethod;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorWithdrawRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorWithdrawRequestDataTable $datatable)
    {
        $total_withdraw_with_charges = WithdrawRequest::where('vendor_id', auth()->user()->vendor->id)
        ->where("status", 'paid')->sum(DB::raw("amount + amount * charge / 100"));
        $total_earnings = OrderProduct::whereHas('order', function($query)
        {
            $query->where('order_status', 'delivered');
        })
        ->whereHas('product', function ($query) {
            $query->where('vendor_id', auth()->user()->vendor->id);
        })
        ->sum(DB::raw('(order_product_price + variant_total) * qty'));
        $current_balance = $total_earnings - $total_withdraw_with_charges;
        $current_balance = round( $current_balance, 2);
        return $datatable->render('vendor.withdraw.index', compact('total_withdraw_with_charges', 'current_balance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $withdraw_methods = WithdrawMethod::where('status', 1)->get();
        return view('vendor.withdraw.create', compact('withdraw_methods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'method'=>'required|max:255|string',
            'amount'=>'required|numeric',
            'account_informations'=>'required|string|max:2000',
        ]);
        $withdraw_method = WithdrawMethod::where('name', $request->method)->firstOrFail();
        if ($request->amount < $withdraw_method->min_amount)
        {
            toastr()->error('The withdraw amount doesn\'t have to be less than the minimum authorized amount');
            return redirect()->back();
        }
        else if ($request->amount > $withdraw_method->max_amount)
        {
            toastr()->error('The withdraw amount doesn\'t have to pass the maximum authorized amount');
            return redirect()->back();
        }
        $total_withdraw_with_charges = WithdrawRequest::where('vendor_id', auth()->user()->vendor->id)
        ->where("status", 'paid')->sum(DB::raw("amount + amount * charge / 100"));
        $total_earnings = OrderProduct::whereHas('order', function($query)
        {
            $query->where('order_status', 'delivered');
        })
        ->whereHas('product', function ($query) {
            $query->where('vendor_id', auth()->user()->vendor->id);
        })
        ->sum(DB::raw('(order_product_price + variant_total) * qty'));
        $current_balance = $total_earnings - $total_withdraw_with_charges;
        if ($request->amount > $current_balance / (1 + $withdraw_method->charge / 100 ))
        {
            toastr()->error('You don\'t have enough balance');
            return redirect()->back();
        }
        $not_allowed = WithdrawRequest::where('vendor_id', auth()->user()->vendor->id)->where('status', '=', 'pending')->first();
        if ($not_allowed)
        {
            toastr()->error('You can\'t pass a request, please wait even the admin validate the previous request!');
            return redirect()->back();
        }
        WithdrawRequest::create([
            'method'=>$request->method,
            'amount'=>round($request->amount, 2),
            'account_informations'=>$request->account_informations,
            'charge'=>$withdraw_method->charge,
            'vendor_id'=>auth()->user()->vendor->id

        ]);
        toastr()->success('Withdraw request submitted successfully');
        return redirect()->route('vendor.withdraw.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $withdraw_request = WithdrawRequest::where('vendor_id', auth()->user()->vendor->id)->findOrFail($id);
        return view('vendor.withdraw.show', compact('withdraw_request'));
    }


}
