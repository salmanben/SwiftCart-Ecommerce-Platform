<?php

namespace App\Http\Controllers\backend;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $datatable)
    {
        return $datatable->render('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'code'=>'required|string|max:255|unique:coupons,code',
            'quantity'=>'required|integer|min:1',
            'max_use'=>'required|integer|min:1',
            'discount_type'=>'required',
            'discount'=>'required|numeric',
            'start_date'=>'required|before:end_date|after_or_equal:'.now()->toDateString(),
            'end_date'=>'required|after:start_date|after:'.now()->toDateString(),
        ],
        [],
        ['discount'=>'discount value']

);

        Coupon::create([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'quantity' => $request->input('quantity'),
            'max_use' => $request->input('max_use'),
            'total_use' => 0,
            'discount_type' => $request->input('discount_type'),
            'discount' => $request->input('discount'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'status' => $request->input('status'),
        ]);

        toastr()->success("Coupon Created Successfully!");
        return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'code'=>'required|string|max:255|unique:coupons,code,'.$id,
            'quantity'=>'required|integer|min:1',
            'max_use'=>'required|integer|min:1',
            'discount_type'=>'required',
            'discount'=>'required|numeric',
            'start_date'=>'required|before:end_date|after_or_equal:'.now()->toDateString(),
            'end_date'=>'required|after:start_date|after:'.now()->toDateString(),
        ],
        [],
        ['discount'=>'discount value']);

        $coupon = Coupon::findOrFail($id);
        $coupon->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'quantity' => $request->input('quantity'),
            'max_use' => $request->input('max_use'),
            'discount_type' => $request->input('discount_type'),
            'discount' => $request->input('discount'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'status' => $request->status,
        ]);

        toastr()->success("Coupon Updated Successfully!");
        return redirect()->route('admin.coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return response(['status' => 'success', 'message' => 'Coupon Deleted Successfully!']);
    }

    /**
     * Change status.
     */

     public function switch_status(Request $request)
     {
        $coupon = Coupon::findOrFail($request->id);
        $coupon->update(['status'=>$request->checked]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
     }
}
