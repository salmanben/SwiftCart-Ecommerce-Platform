<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\UserOrderDataTable;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(UserOrderDataTable $datatable)
    {
        return $datatable->render('frontend.dashboard.order.index');
    }

    function show($id)
    {
        $order = Order::findOrFail($id);
        
        if ($order->user_id != auth()->user()->id)
           abort(403);
        return view('frontend.dashboard.order.show', compact('order'));
    }
}
