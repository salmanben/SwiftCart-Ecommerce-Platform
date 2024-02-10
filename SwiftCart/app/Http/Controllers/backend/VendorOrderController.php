<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\VendorOrderDataTable;
use App\Models\Order;
use App\Models\OrderProduct;

class VendorOrderController extends Controller
{
    function index(VendorOrderDataTable $datatable)
    {
        return $datatable->render('vendor.order.index');
    }

    function show($id)
    {
        $order = Order::findOrFail($id);
        $allowed = false;
        foreach ($order->order_products as $item) {
            if ($item->product->vendor_id == auth()->user()->vendor->id) {
                $allowed = true;
                break;
            }
        }
        if (!$allowed) {
            abort(403);
        }
        $disabled = ($order->order_status != 'pending' and $order->order_status != 'processed_and_ready_to_ship') ? "disabled" : "";
        return view('vendor.order.show', compact('order', 'disabled'));
    }

    /**
     * Change status.
     */
    public function switch_status(Request $request)
    {
        $order_products = OrderProduct::where('order_id', $request->id)
            ->whereHas('product', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            })->get();

        foreach ($order_products as $order_product) {
            $order_product->update(['status' => $request->value]);
        }

        return response(['status' => 'success', 'message' => 'Order Status Changed Successfully!', 'products'=>$order_products]);
    }

}
