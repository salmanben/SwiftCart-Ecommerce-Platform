<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Traits\Image_Handle;
use Illuminate\Validation\ValidationException;

class VendorShopProfileController extends Controller
{
    use Image_Handle;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendor = Vendor::where('user_id', auth()->user()->id)->first();
        return view('vendor.shop_profile.index', compact('vendor'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vendor = Vendor::findOrFail($id);
        $request->validate([
            'banner'=>['nullable', 'image', 'max:2040'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:vendors,email,'.$id],
            'shop_name'=> ['required', 'string', 'max:255', 'unique:vendors,shop_name,'.$id],
            'phone' => ['required', 'regex:/^[0-9\(\)\+\-\s]{7,20}$/','unique:vendors,phone,'.$id],
            'address'=>['required', 'string'],
            'description'=>['required', 'string'],
            'fb_link'=>['nullable', 'url'],
            'insta_link'=>['nullable', 'url'],
            'tw_link'=>['nullable', 'url'],
        ]);
        if (strtolower($request->shop_name) == strtolower(config('app.name')))
        {
            throw ValidationException::withMessages([
                'shop_name'=>'Invalid Shop Name'
            ]);
            return redirect()->back();
        }

        $banner = $request->banner ? $this->image_update($request, 'banner', 'upload', $vendor->banner) : $vendor->banner;

        $vendor->update([
            'banner'=>$banner,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'address'=>$request->address,
            'description'=>ucfirst($request->description),
            'shop_name'=>ucfirst($request->shop_name),
            'fb_link'=>$request->fb_link,
            'insta_link'=>$request->insta_link,
            'tw_link'=>$request->tw_link,
        ]);

        toastr()->success('Vendor Shop Profile Updated Successfully!');
        return redirect()->back();
    }

}
