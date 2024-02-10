<?php

namespace App\Http\Controllers\backend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use App\traits\Image_Handle;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    use Image_Handle;

    public function index()
    {
        return view('admin.profile.index');
    }
    public function update_profile(Request $request)
    {
        $admin = auth()->user();
        $request->validate([
            'name' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$admin->id],
            'phone' => ['required', 'regex:/^[0-9\(\)\+\-\s]{7,20}$/', 'unique:users,phone,'.$admin->id],
            'image' => ['nullable', 'image', 'max:2048'],

        ]);
        $image = $request->image ? $this->image_update($request, 'image', 'upload', $admin->image) : $admin->image;

        $admin->update([
            'name' => ucfirst($request->name),
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

        $admin = auth()->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            throw ValidationException::withMessages([
                'current_password' => "Incorrect password.",
            ]);
        }

        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        toastr()->success('Password Updated Successfully!');
        return redirect()->back();
    }

}
