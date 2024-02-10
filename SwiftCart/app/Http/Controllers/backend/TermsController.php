<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Terms;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        $terms = Terms::first();
        return view('admin.terms.index', compact('terms'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'content'=>'required'
        ]);
        Terms::updateOrCreate(
          ['id'=>1],
          ['content'=>$request->content]
        );

        toastr()->success('Content saved successfully');
        return redirect()->back();

    }
}
