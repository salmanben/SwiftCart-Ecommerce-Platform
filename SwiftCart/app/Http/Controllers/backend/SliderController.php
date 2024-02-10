<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;

use Illuminate\Http\Request;
use App\Traits\Image_Handle;
use App\DataTables\SlidersDataTable;
use Exception;

class SliderController extends Controller
{
    use Image_Handle;

    /**
     * Display a listing of the resource.
     */

    public function index(SlidersDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => ['nullable', 'string', 'max:200'],
            'title' => ['required', 'string', 'max:200'],
            'starting_price' => ['nullable', 'numeric'],
            'btn_url' => ['required', 'url'],
            'order' => ['required', 'integer', 'unique:sliders,order'],
            'banner' => ['required', 'image', 'max:3048'],
        ]);

        $banner = $this->image_upload($request, 'banner', 'upload');
        Slider::create([
            'type' => $request->type,
            'title' => $request->title,
            'starting_price' => $request->starting_price,
            'btn_url' => $request->btn_url,
            'order' => $request->order,
            'status' => $request->status,
            'banner' => $banner,
        ]);

        toastr()->success('Slider Created Successfully!');

        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::findOrFail($id);
        $data = $request->validate([
            'type' => ['nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:200'],
            'starting_price' => ['nullable', 'numeric'],
            'btn_url' => ['required', 'url'],
            'order' => ['required', 'integer', 'unique:sliders,order,'.$id],
            'banner' => ['nullable', 'image', 'max:3048'],
        ]);

        $banner = $request->banner ? $this->image_update($request, 'banner', 'upload', $slider->banner) : $slider->banner;
        $slider->update([
            'type' => $request->type,
            'title' => $data['title'],
            'starting_price' => $data['starting_price'],
            'btn_url' => $data['btn_url'],
            'order' => $data['order'],
            'status' => $request->status,
            'banner' => $banner,
        ]);

        toastr()->success('Slider Updated Successfully!');

        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $slider = Slider::findOrFail($id);
        $this->delete_image('upload', $slider->banner);
        $slider->delete();
        return response(['status'=>'success', 'message'=>'Slider Deleted Successfully!']);
    }


    /**
     * Change status.
     */

     public function switch_status(Request $request)
     {
        $slider = Slider::findOrFail($request->id);
        $slider->update(['status'=>$request->checked]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
     }
}
