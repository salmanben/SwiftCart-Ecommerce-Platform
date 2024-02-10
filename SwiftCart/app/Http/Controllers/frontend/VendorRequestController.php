<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Traits\Image_Handle;

class VendorRequestController extends Controller
{
    use Image_Handle;

    public function create()
    {
       return view('frontend.dashboard.vendor_request');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner'=>['required','image', 'max:2040'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:vendors,email'],
            'shop_name'=> ['required', 'string', 'max:255','different:'.config('app.name'), 'unique:vendors,shop_name'],
            'phone' => ['required', 'regex:/^[0-9\(\)\+\-\s]{7,20}$/'],
            'address'=>['required', 'string'],
            'description'=>['required', 'string'],
            'fb_link'=>['nullable', 'url'],
            'insta_link'=>['nullable', 'url'],
            'tw_link'=>['nullable', 'url'],
        ]);

        $banner = $this->image_upload($request, 'banner', 'upload');

        Vendor::create([
            'user_id'=>auth()->user()->id,
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

        toastr()->success('Request Submitted Successfully!');
        return redirect()->back();
    }
}
