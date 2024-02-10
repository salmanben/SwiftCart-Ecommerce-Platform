<?php

namespace App\Http\Controllers\frontend;

use App\DataTables\ReviewUserDataTable;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Traits\Image_Handle;

class ReviewController extends Controller
{
    use Image_Handle;

    public function index(ReviewUserDataTable $datatable)
    {
         return $datatable->render('frontend.dashboard.review');
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'image.*' => 'nullable|image|max:2048',
            'rating' => 'required',
            'vendor_id'=>'required',
            'product_id' => 'required',
        ]);

        if ($request->image && count($request->image) > 5)
        {
            toastr()->error("You can't upload more than 5 images");
            return redirect()->back();
        }
        if ($request->rating == 0)
        {
            toastr()->error("You must select review rating");
            return redirect()->back();
        }
        $images = $this->multiple_image_upload($request, 'image', 'upload');


        Review::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'vendor_id'=>$request->vendor_id,
            'image' => json_encode($images),
        ]);

        toastr()->success('Review Added Successfully');
        return redirect()->back();
    }


    public function delete($id)
    {
        $review = Review::findOrFail($id);
        $images = json_decode($review->image);
        foreach($images as $image)
        {
            $this->delete_image('upload', $image);
        }
        $review->delete();
        return response(['status' => 'success', 'message' => 'Review Deleted Successfully!']);
    }
}
