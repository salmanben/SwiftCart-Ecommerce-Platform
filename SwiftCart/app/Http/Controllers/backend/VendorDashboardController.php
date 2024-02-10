<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VendorDashboardController extends Controller
{
    public function index()
    {
        $total_orders = Order::whereHas('order_products', function ($query) {
            $query->whereHas('product', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            });
        })->count();
        $completed_orders = Order::where('order_status', 'delivered')->whereHas('order_products', function ($query) {
            $query->whereHas('product', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            });
        })->count();
        $pending_orders = Order::where('order_status', 'pending')->whereHas('order_products', function ($query) {
            $query->whereHas('product', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            });
        })->count();
        $avg_reviews = Review::where('vendor_id', auth()->user()->vendor->id)->avg('rating');
        $avg_reviews = round($avg_reviews);
        $products = Product::where('vendor_id', auth()->user()->vendor->id)->count();
        $total_earnings = OrderProduct::whereHas('order', function($query)
        {
            $query->where('order_status', 'delivered');
        })
        ->whereHas('product', function ($query) {
            $query->where('vendor_id', auth()->user()->vendor->id);
        })
        ->sum(DB::raw('(order_product_price + variant_total) * qty'));

        $current_year_earnings = OrderProduct::whereHas('order', function($query)
        {
            $query->where('order_status', 'delivered');
        })
        ->whereHas('product', function ($query) {
            $query->where('vendor_id', auth()->user()->vendor->id);
        })
        ->whereYear('created_at', Carbon::now()->year)->sum(DB::raw('(order_product_price + variant_total) * qty'));

        $current_month_earnings =OrderProduct::whereHas('order', function($query)
        {
            $query->where('order_status', 'delivered');
        })
        ->whereHas('product', function ($query) {
            $query->where('vendor_id', auth()->user()->vendor->id);
        })
        ->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)->sum(DB::raw('(order_product_price + variant_total) * qty'));

        $today_earnings = OrderProduct::whereHas('order', function($query)
        {
            $query->where('order_status', 'delivered');
        })
        ->whereHas('product', function ($query) {
            $query->where('vendor_id', auth()->user()->vendor->id);
        })
        ->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereDay('created_at', Carbon::now()->day)->sum(DB::raw('(order_product_price + variant_total) * qty'));

        $data_orders = $data_earning  = [];
        for ($i = 1; $i <= date('m'); $i++) {
            $row = Order::whereHas('order_products', function ($query) {
                $query->whereHas('product', function ($query) {
                    $query->where('vendor_id', auth()->user()->vendor->id);
                });
            })->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $i)->count();
            $data_orders[] = $row;
        }
        for ($i = date('m') + 1; $i <= 12; $i++) {
            $data_orders[] = 0;
        }

        for ($i = 1; $i <= date('m'); $i++) {
            $row = OrderProduct::whereHas('order', function($query)
            {
                $query->where('order_status', 'delivered');
            })
            ->whereHas('product', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            })
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', $i)
            ->sum(DB::raw('(order_product_price + variant_total) * qty'));
            $data_earning[] = $row;
        }
        for ($i = date('m') + 1; $i <= 12; $i++) {
            $data_earning[] = 0;
        }

        return view('vendor.dashboard.dashboard', compact('total_orders', 'completed_orders', 'pending_orders', 'avg_reviews', 'products', 'total_earnings', 'current_month_earnings', 'today_earnings', 'current_year_earnings', 'data_orders', 'data_earning'));
    }

    public function get_chart(Request $request)
    {
        $data = [];
        if ($request->chartType == 'chart-orders')
        {
            for ($i = 1; $i <= 12; $i++) {
                $row = Order::whereHas('order_products', function ($query) {
                    $query->whereHas('product', function ($query) {
                        $query->where('vendor_id', auth()->user()->vendor->id);
                    });
                })->whereYear('created_at', $request->year)->whereMonth('created_at', $i)->count();
                $data[] = $row;
            }
        }
        else if($request->chartType == 'chart-earning')
        {
            for ($i = 1; $i <= 12; $i++) {
                $row = OrderProduct::whereHas('order', function($query)
                {
                    $query->where('order_status', 'delivered');
                })
                ->whereHas('product', function ($query) {
                    $query->where('vendor_id', auth()->user()->vendor->id);
                })
                ->whereYear('created_at', $request->year)
                ->whereMonth('created_at', $i)
                ->sum(DB::raw('(order_product_price + variant_total) * qty'));
                $data[] = $row;
            }
        }

        return response(['status' => 'success', 'data' => $data]);
    }
}
