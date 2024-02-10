<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $total_orders = Order::count();
        $completed_orders = Order::where('order_status', 'delivered')->count();
        $pending_orders = Order::where('order_status', 'pending')->count();
        $total_reviews = Review::count();
        $products = Product::count();
        $total_earnings = Order::where('order_status', 'delivered')->sum('sub_total');
        $current_year_earnings = Order::where('order_status', 'delivered')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('sub_total');
        $current_month_earnings = Order::where('order_status', 'delivered')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('sub_total');
        $today_earnings = Order::where('order_status', 'delivered')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereDay('created_at', Carbon::now()->day)
            ->sum('sub_total');
        $newsletter_subscribers = NewsletterSubscriber::where('is_verified', 1)->count();
        $customers = User::where('role', '!=', 'admin')->where('email_verified_at', '!=', null)->count();
        $vendors = User::where('role', 'vendor')->count();
        $admins = User::where('role', 'admin')->count();
        $brands = Brand::count();
        $data_orders = $data_subscribers = $data_customers = $data_earning = [];

        for ($i = 1; $i <= date('m'); $i++) {
            $row = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $i)->count();
            $data_orders[] = $row;
        }
        for ($i = date('m') + 1; $i <= 12; $i++) {
            $data_orders[] = 0;
        }

        for ($i = 1; $i <= date('m'); $i++) {
            $row = NewsletterSubscriber::where('is_verified', 1)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $i)->count();
            $data_subscribers[] = $row;
        }
        for ($i = date('m') + 1; $i <= 12; $i++) {
            $data_subscribers[] = 0;
        }

        for ($i = 1; $i <= date('m'); $i++) {
            $row = User::where('role', '!=', 'admin')->where('email_verified_at', '!=', null)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $i)->count();
            $data_customers[] = $row;
        }
        for ($i = date('m') + 1; $i <= 12; $i++) {
            $data_customers[] = 0;
        }

        for ($i = 1; $i <= date('m'); $i++) {
            $row = Order::where('order_status', 'delivered')
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $i)
                ->sum('sub_total');
            $data_earning[] = $row;
        }
        for ($i = date('m') + 1; $i <= 12; $i++) {
            $data_earning[] = 0;
        }

        $data_order_status = [];
        $order_status = config('order_status.order_status_admin');
        foreach($order_status as $key => $value)
        {
            $data_order_status[] = Order::where('order_status', $key)->count();

        }

        return view('admin.dashboard.dashboard', compact(
            'total_orders',
            'completed_orders',
            'pending_orders',
            'total_reviews',
            'products',
            'total_earnings',
            'current_month_earnings',
            'today_earnings',
            'current_year_earnings',
            'newsletter_subscribers',
            'customers',
            'vendors',
            'admins',
            'brands',
            'data_orders',
            'data_subscribers',
            'data_customers',
            'data_earning',
            'data_order_status'
        ));
    }

    public function get_chart(Request $request)
    {
        $data = [];
        switch ($request->chartType) {
            case 'chart-orders': {
                    for ($i = 1; $i <= 12; $i++) {
                        $row = Order::whereYear('created_at', $request->year)->whereMonth('created_at', $i)->count();
                        $data[] = $row;
                    }
                    break;
                }
            case 'chart-subscribers': {
                    for ($i = 1; $i <= 12; $i++) {
                        $row = NewsletterSubscriber::whereYear('created_at', $request->year)->whereMonth('created_at', $i)->count();
                        $data[$i - 1] = $row;
                    }
                    break;
                }
            case 'chart-customers': {
                    for ($i = 1; $i <= 12; $i++) {
                        $row = User::where('role', '!=', 'admin')->where('email_verified_at', '!=', null)->whereYear('created_at', $request->year)->whereMonth('created_at', $i)->count();
                        $data[] = $row;
                    }
                    break;
                }
            case 'chart-earning': {
                    for ($i = 1; $i <= 12; $i++) {
                        $row = Order::where('order_status', 'delivered')
                            ->whereYear('created_at', $request->year)
                            ->whereMonth('created_at', $i)
                            ->sum('sub_total');
                        $data[] = $row;
                    }
                    break;
                }
        }
        return response(['status' => 'success', 'data' => $data]);
    }
}
