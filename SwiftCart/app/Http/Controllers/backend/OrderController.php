<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\OrderDataTable;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $datatable)
    {
        return $datatable->render('admin.order.index');
    }

    public function show_orders_by_status(OrderDataTable $datatable)
    {
        return $datatable->render('admin.order.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Change status.
     */
     public function switch_status(Request $request)
     {
        $order = Order::findOrFail($request->id);
        $order->update(['order_status'=>$request->value]);
        return response(['status'=>'success', 'message'=>'Order Status Changed Successfully!']);
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrfail($id);
        $order->delete();
        return response(['status'=>'success', 'message'=>'Order Deleted Successfully!']);
    }
}
