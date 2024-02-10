<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\DataTables\ReviewAdminDataTable;
use App\Traits\Image_Handle;

class ReviewController extends Controller
{
    use Image_Handle;

    public function index(ReviewAdminDataTable $datatable)
    {
         return $datatable->render('admin.review.index');
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
