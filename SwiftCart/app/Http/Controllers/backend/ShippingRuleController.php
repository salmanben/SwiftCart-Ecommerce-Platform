<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Datatables\ShippingRuleDataTable;
use App\Models\ShippingRule;
use Illuminate\Validation\ValidationException;

class ShippingRuleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(ShippingRuleDataTable $datatable)
    {
        return $datatable->render('admin.shipping_rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping_rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:200|string',
            'cost'=>'required|numeric',
            'min_cost'=>'nullable|numeric',
            'type'=>'required',
        ]);
        if ($request->type == 'min_cost' && $request->min_cost == '') {
            throw ValidationException::withMessages([
                'min_cost' => 'min cost field is required'
            ]);
        }

        ShippingRule::create($request->except('_token'));
        toastr()->success('Shipping Rule Created Successfully!');
        return redirect()->route('admin.shipping_rule.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shipping_rule = ShippingRule::findOrFail($id);
        return view('admin.shipping_rule.edit', compact('shipping_rule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|max:200|string',
            'cost'=>'required|numeric',
            'min_cost'=>'nullable|numeric',
            'type'=>'required',
        ]);

        if ($request->type == 'min_cost' && $request->min_cost == '') {
            throw ValidationException::withMessages([
                'min_cost' => 'min cost field is required'
            ]);
        }
        $shipping_rule = ShippingRule::findOrFail($id);
        $shipping_rule->update([
            'name'=>$request->name,
            'cost'=>$request->cost,
            'min_cost'=>$request->min_cost,
            'type'=>$request->type,
            'status'=>$request->status,
        ]);
        toastr()->success('Shipping Rule Updated Successfully!');
        return redirect()->route('admin.shipping_rule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipping_rule = ShippingRule::findOrFail($id);
        $shipping_rule->delete();
        return response(['status'=>'success', 'message'=>'Shipping rule Deleted Successfully!']);
    }


    /**
     * Change status.
     */

     public function switch_status(Request $request)
     {
        $shipping_rule = ShippingRule::findOrFail($request->id);
        $shipping_rule->update(['status'=>$request->checked]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
     }
}
