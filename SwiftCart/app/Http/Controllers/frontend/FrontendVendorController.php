<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use App\Models\Vendor;
use Illuminate\Http\Request;

class FrontendVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vendors = Vendor::where('status', 1)
        ->with('user')
        ->withAvg('reviews', 'rating')
        ->withCount('reviews')
        ->when($request->has('search'), function($query)use($request)
        {
            $query->whereHas('user', function($query)use($request)
            {
                $query->where('name','like','%'.$request->search.'%');
            })
            ->orWhere('shop_name', 'like','%'.$request->search.'%');
        })
        ->paginate(9);
        $search = $request->search ?? '';
        return view('frontend.pages.vendor', compact('vendors', 'search'));

    }

}
