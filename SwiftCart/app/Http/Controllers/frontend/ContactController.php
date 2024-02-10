<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        $general_setting = GeneralSetting::first();
        return view('frontend.pages.contact', compact('general_setting'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^[0-9\(\)\+\-\s]{7,20}$/',
            'message' => 'required|string|max:2000'
        ]);
        Contact::create($request->except('_token'));
        toastr()->success('Form submitted successfully');
        return redirect('/');

    }
}
