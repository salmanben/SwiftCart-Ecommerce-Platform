<?php

namespace App\Http\Controllers\backend;

use App\DataTables\WithdrawMethodDataTable;
use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;

class WithdrawMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WithdrawMethodDataTable $datatable)
    {
        return $datatable->render('admin.withdraw_method.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.withdraw_method.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255|unique:withdraw_methods,name',
            'status'=>'required',
            'charge'=>'required|numeric',
            'min_amount'=>'required|numeric|lt:max_amount',
            'max_amount'=>'required|numeric|gt:min_amount',
        ]);
        WithdrawMethod::create($request->except('_token'));
        toastr()->success('Withdraw method created successfully');
        return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $withdraw_method = WithdrawMethod::findOrFail($id);
        return view('admin.withdraw_method.edit', compact('withdraw_method'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $withdraw_method = WithdrawMethod::findOrFail($id);
        $request->validate([
            'name'=>'required|string|max:255|unique:withdraw_methods,name,'.$id,
            'status'=>'required',
            'charge'=>'required|numeric',
            'min_amount'=>'required|numeric|lt:max_amount',
            'max_amount'=>'required|numeric|gt:min_amount',
        ]);
        $withdraw_method->update($request->except('_token', '_method'));
        toastr()->success('Withdraw method upated successfully');
        return redirect()->route('admin.withdraw_method.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $withdraw_method = WithdrawMethod::findOrFail($id);
        $withdraw_method->delete();
        return response(['status'=>'success', 'message'=>'Withdraw method deleted successfully']);
    }

    /**
     * Change status.
     */

     public function switch_status(Request $request)
     {
        $withdraw_method = WithdrawMethod::findOrFail($request->id);
        $withdraw_method->update(['status'=>$request->checked]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
     }
}
