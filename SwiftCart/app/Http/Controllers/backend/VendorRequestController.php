<?php

namespace App\Http\Controllers\backend;

use App\DataTables\VendorRequestDataTable;
use App\Http\Controllers\Controller;
use App\Events\VendorRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Traits\Image_Handle;

class VendorRequestController extends Controller
{
    use Image_Handle;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorRequestDataTable $datatable)
    {
        return $datatable->render('admin.vendor_request.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vendor_request = Vendor::findOrFail($id);
        if ($vendor_request->status == 1)
           abort(404);
        return view('admin.vendor_request.show', compact('vendor_request'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update([
            'status'=>'1'
        ]);
       $vendor->user()->update(['role'=>'vendor']);
       $subject = 'Request Response';
       $message = 'Your request has been Approved.';
       $data = ['subject'=>$subject, 'message'=>$message, 'email'=>$vendor->user->email];
       event(new VendorRequest($data));
       toastr()->success('Request approved successfully');
       return redirect()->route('admin.vendor_request.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $vendor = Vendor::findOrFail($id);
        $subject = 'Request Response';
        $message = 'Your request has been rejected!';
        $data = ['subject'=>$subject, 'message'=>$message, 'email'=>$vendor->user->email];
        event(new VendorRequest($data));
        $this->delete_image('upload', $vendor->banner);
        $vendor->delete();
        toastr()->success('Request rejected successfully');
        return redirect()->route('admin.vendor_request.index');
    }
}
