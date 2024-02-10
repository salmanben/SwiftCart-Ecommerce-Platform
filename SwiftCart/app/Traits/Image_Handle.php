<?php
namespace app\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait Image_Handle
{
 public function image_upload(Request $request, $name, $path)
 {
    if ($request->hasFile($name))
    {
        $file = $request->file($name);
        $image = "Image_".uniqid().'.'.$file->getClientOriginalExtension();
        $file->storeAs($path, $image);
        return $image;
    }
 }

 public function multiple_image_upload(Request $request, $name, $path)
 {
    $arr_image_name = [];
    if ($request->hasFile($name))
    {
        $images = $request->{$name};
        foreach($images as $image)
        {
            $img_name = "Image_".uniqid().'.'.$image->getClientOriginalExtension();
            $image->storeAs($path, $img_name);
            array_push($arr_image_name, $img_name);
        }

    }
    return $arr_image_name;
 }

 public function image_update(Request $request, $name, $path, $old_image)
 {

    $file = $request->file($name);
    $image = "Image_".uniqid().'.'.$file->getClientOriginalExtension();
    $file->storeAs($path, $image);
    if ($old_image)
        if (Storage::exists($path.'/'.$old_image))
            Storage::delete($path.'/'.$old_image);
    return $image;
 }

 public function delete_image($path, $image)
 {
    if (Storage::exists($path.'/'.$image))
            Storage::delete($path.'/'.$image);
 }
}
