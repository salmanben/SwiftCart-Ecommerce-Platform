<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Terms;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        $terms = Terms::first();
        return view('frontend.pages.terms', compact('terms'));
    }
}
