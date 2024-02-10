<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Review;

class UserDashboardController extends Controller
{
   public function index()
   {
    $total_orders = Order::where('user_id', auth()->user()->id)->count();
    $completed_orders = Order::where('user_id', auth()->user()->id)->where('order_status', 'delivered')->count();
    $pending_orders = Order::where('user_id', auth()->user()->id)->where('order_status', 'pending')->count();
    $total_reviews = Review::where('user_id', auth()->user()->id)->count();
    return view('frontend.dashboard.dashboard', compact('total_orders', 'completed_orders', 'pending_orders', 'total_reviews'));
   }
}
