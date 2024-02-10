<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FooterInfo;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use App\Traits\Image_Handle;

class HomeSettingController extends Controller
{
    use Image_Handle;
    function index()
    {
        $top_categories = HomeSetting::where('key', 'top_categories')->first();
        if ($top_categories)
        {
            $top_categories = $top_categories->value;
            $top_categories = json_decode($top_categories);
        }
        else
           $top_categories = [];
        $single_categories = HomeSetting::where('key', 'single_categories')->first();
           if ($single_categories)
           {
               $single_categories = $single_categories->value;
               $single_categories = json_decode($single_categories);
           }
           else
               $single_categories = [];
        $categories = Category::where('status', 1)->get();
        $footer_info  = FooterInfo::first();
        $box_background = HomeSetting::where('key', 'box_background')->first();
        if ($box_background != null)
            $box_background = $box_background->value;
        return view('admin.home_setting.index', compact('categories', 'top_categories', 'single_categories', 'footer_info', 'box_background'));
    }

    function update_top_categories(Request $request)
    {
        session()->put('home_setting', 'top-categories');
        HomeSetting::updateOrInsert(
            ['id' => 1],
            [
                'key' => 'top_categories',
                'value' => json_encode($request->category)
            ]
        );

        toastr()->success('Settings Saved Successfully');
        return redirect()->back();
    }

    function update_single_categories(Request $request)
    {
        session()->put('home_setting', 'single-categories');
        HomeSetting::updateOrInsert(
            ['id' => 2],
            [
                'key' => 'single_categories',
                'value' => json_encode($request->category)
            ]
        );

        toastr()->success('Settings Saved Successfully');
        return redirect()->back();
    }

    function update_footer_info(Request $request)
    {
        session()->put('home_setting', 'footer');
        $request->validate([
            'email'=>'required|email||max:255',
            'phone'=>'required|regex:/^[0-9\(\)\+\-\s]{7,20}$/',
            'address'=>'required|string',
            'copyright'=>'required|string',
            'facebook'=>'nullable|url',
            'twitter'=>'nullable|url',
            'instagram'=>'nullable|url',
            'whatsapp'=>'nullable|url'

        ]);
        FooterInfo::updateOrInsert(
            ['id'=>1],
            $request->except('_token', '_method'));

        toastr()->success('Footer settings saved successfully');
        return redirect()->back();
    }

    function update_box_background(Request $request)
    {
        session()->put('home_setting', 'box_background');
        $request->validate([
            'box_background'=>'required|image'

        ]);
        $home_setting = HomeSetting::where('key', 'box_background')->first();
        if ($home_setting)
           $old_background = $home_setting->value;
        else
           $old_background = '';
        $box_background = $this->image_update($request, 'box_background', 'upload', $old_background);
        HomeSetting::updateOrInsert(
            ['id'=>3],
            ['key'=>'box_background',
            'value'=>$box_background
            ]
            );

        toastr()->success('Background saved successfully');
        return redirect()->back();
    }
}
