<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;

use App\DataTables\ReviewVendorDataTable;

class VendorReviewController extends Controller
{
    public function index(ReviewVendorDataTable $datatable)
    {
        return $datatable->render('vendor.review.index');
    }

}
