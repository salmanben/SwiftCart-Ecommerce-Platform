<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Traits\Image_Handle;

class VendorController extends Controller
{
    use Image_Handle;

    public function index()
    {
        return view('vendor.profile.profile');
    }

    public function update_profile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone' => ['nullable', 'regex:/^[0-9\(\)\+\-\s]{7,20}$/', 'unique:users,phone,'.$user->id],
            'image' => ['nullable', 'image', 'max:2048'],

        ]);

        $image = $request->image ? $this->image_update($request, 'image', 'upload', $user->image) : $user->image;
        $user->update([
            'name' =>  ucfirst($request->name),
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $image,
        ]);

        toastr()->success('Profile Updated Successfully!');
        return redirect()->back();
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => 'required',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => "Incorrect password.",
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        toastr()->success('Password Updated Successfully!');
        return redirect()->back();
    }
}
