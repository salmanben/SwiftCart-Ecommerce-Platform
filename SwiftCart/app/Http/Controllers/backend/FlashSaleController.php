<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\FlashSaleItemDataTable;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use App\Traits\Image_Handle;

class FlashSaleController extends Controller
{

    use Image_Handle;
    /**
     * Display a listing of the resource.
     */
    public function index(FlashSaleItemDataTable $datatable)
    {
        $flash_sale = FlashSale::first();
        $products = Product::where('status', 1)->where('is_approved', 1)
                    ->where('quantity', '>', '0')
                    ->whereRaw('id not in (Select product_id from flash_sale_items)')
                    ->get();

        return $datatable->render('admin.flash_sale.index', compact('flash_sale', 'products'));
    }

    /**
     * Store End Date
     */

     public function save_end_date(Request $request)
     {
        $request->validate([
            'end_date'=>'required|after:'.now()->toDateString(),
            'background'=>'nullable|image|max:2048'
        ]);
        $flash_sale = FlashSale::first();
        if ($flash_sale)
           $old_background = $flash_sale->background;
        else
           $old_background = '';
        $background = $request->has('background')? $this->image_update($request, 'background', 'upload', $old_background) : $old_background;
        FlashSale::updateOrInsert(
            ['id' => 1],
            ['end_date' => $request->end_date,
            'background'=>$background
            ]
        );
        toastr()->success('Flash Sale Saved Successfully!');
        return redirect()->back();
     }

    /**
     * Store flash sale items in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product'=>['required'],
            'show_at_home'=>'required',
        ]);

        FlashSaleItem::create([
            'product_id'=>$request->product,
            'status'=>$request->status,
            'show_at_home'=>$request->show_at_home,
            'flash_sale_id'=>FlashSale::first()->id
        ]);
        toastr()->success('Flash Sale Item Created Successfully!');
        return redirect()->back();

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flash_sale_item = FlashSaleItem::findOrFail($id);
        $flash_sale_item->delete();
        return response(['status'=>'success', 'message'=>'Flash Sale Item Deleted Successfully!']);
    }


    /**
     * Change status.
     */

     public function switch_status(Request $request)
     {
        $flash_sale_item = FlashSaleItem::findOrFail($request->id);
        $flash_sale_item->update(['status'=>$request->checked]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
     }

    /**
     * Change show at home status.
     */

     public function switch_show_at_home_status(Request $request)
     {
        $flash_sale_item = FlashSaleItem::findOrFail($request->id);
        $flash_sale_item->update(['show_at_home'=>$request->checked]);
        return response(['status'=>'success', 'message'=>'Status Changed Successfully!']);
     }
}
