<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
class UserAddressController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = UserAddress::where('user_id', auth()->user()->id)->get();
        return view('frontend.dashboard.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.dashboard.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^[0-9\(\)\+\-\s]{7,20}$/',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'country'=>'required',
            'address' => 'required|string',
        ]);

        UserAddress::create([
            'user_id'=>auth()->user()->id,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'zip' => $request->input('zip'),
            'address' => $request->input('address'),
        ]);

        toastr()->success('Address Saved  Successfully');
        return redirect()->route('user.address.index');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $address = UserAddress::findOrFail($id);
        return view('frontend.dashboard.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^[0-9\(\)\+\-\s]{7,20}$/',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'country'=>'required',
            'address' => 'required|string',
        ]);

        $address = UserAddress::findOrFail($id);

        $address->update($request->except('_token', '_method'));
        $address = UserAddress::findOrFail($id);
         if (session()->has('address') && session()->get('address')['id'] == $id)
                session()->put('address', $address);
        toastr()->success('Address Updated  Successfully');
        return redirect()->route('user.address.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = UserAddress::findOrFail($id);
        $address->delete();
        return response(['status' => 'success', 'message' => 'Address Deleted Successfully!']);
    }
}
