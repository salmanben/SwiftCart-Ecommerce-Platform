<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('admin.about.index', compact('about'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'content'=>'required'
        ]);
        About::updateOrCreate(
          ['id'=>1],
          ['content'=>$request->content]
        );

        toastr()->success('Content saved successfully');
        return redirect()->back();

    }
}
