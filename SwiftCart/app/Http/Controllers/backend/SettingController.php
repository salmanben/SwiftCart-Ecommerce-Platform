<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\EmailSetting;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use App\Traits\Image_Handle;
use Illuminate\Validation\ValidationException;

class SettingController extends Controller
{
    use Image_Handle;
    public function index()
    {
        $general_setting = GeneralSetting::first();
        $email_setting = EmailSetting::first();
        return view('admin.setting.index', compact('general_setting', 'email_setting'));
    }

    public function update_general_setting(Request $request)
    {
        session()->put('setting', 'general-setting');
        $request->validate([
            'site_name' => 'required|string|max:255',
            'logo' => 'nullable|image',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|regex:/^[0-9\(\)\+\-\s]{7,20}$/',
            'currency_icon' => 'required|string|max:255',

        ]);
        $general_setting = GeneralSetting::first();
        if ($general_setting)
        {
            $old_image = $general_setting->logo;
        }else
        {
            if ($request->logo == null)
            {
                throw ValidationException::withMessages([
                    'logo'=>'The logo field is required'
                ]);
                return redirect()->back();
            }
            $old_image = 'null';
        }
        $image = $request->logo ? $this->image_update($request, 'logo', 'upload', $old_image) : $old_image;
        GeneralSetting::updateOrInsert(
            ['id' => 1],
            [
                'logo'=>$image,
                'site_name' => $request->site_name,
                'contact_email' => $request->contact_email,
                'contact_phone' => $request->contact_phone,
                'currency_icon' => $request->currency_icon,
            ]
        );


        toastr()->success("General Settings Saved  Successfully!");
        return redirect()->back();
    }

    public function update_email_setting(Request $request)
    {
        session()->put('setting', 'email-setting');
        $request->validate([
            'host' => 'required|string|max:255',
            'port' => 'required|integer',
            'encryption' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'from_address' => 'required|string|max:255|email',
            'name' => 'required|string|max:255',
        ]);

        EmailSetting::updateOrInsert(
            ['id' => 1],
            [
                'host' => $request->input('host'),
                'port' => $request->input('port'),
                'encryption' => $request->input('encryption'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'from_address' => $request->input('from_address'),
                'name' => $request->input('name'),
            ]
        );
        toastr()->success("Email Settings Saved  Successfully!");
        return redirect()->back();
    }
}
