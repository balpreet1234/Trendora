<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
class DashboardController extends Controller
{
    //dashboard all listing
    public function dashboard_index() {
        $orderCount = Order::count();
        $customer = User::where('role', 'user')->where('status', 'active')->count();
        $totalProducts = Product::where('status', 'active')->count();
        $totalBrands = Brand::count();
    
        $previousOrderCount = Order::where('created_at', '>=', now()->subWeek())->count();
        $previousCustomerCount = User::where('role', 'user')->where('status', 'active')->where('created_at', '>=', now()->subWeek())->count();
        $previousTotalProducts = Product::where('status', 'active')->where('created_at', '>=', now()->subWeek())->count();
        $previousTotalBrands = Brand::where('created_at', '>=', now()->subWeek())->count();
    
        $orderChange = $this->calculatePercentageChange($previousOrderCount, $orderCount);
        $customerChange = $this->calculatePercentageChange($previousCustomerCount, $customer);
        $productChange = $this->calculatePercentageChange($previousTotalProducts, $totalProducts);
        $brandChange = $this->calculatePercentageChange($previousTotalBrands, $totalBrands);
    
        $recentOrders = Order::orderBy('created_at', 'desc')->take(6)->get();
    
        foreach ($recentOrders as $order) {
            // Assuming cart_ids is a comma-separated string in the Order model
            $cartIds = explode(',', $order->cart_ids); // Adjust this according to your actual column name
            $order->carts = Cart::whereIn('id', $cartIds)->with('product')->get();
        }
    
        return view('dashboard', compact(
            'orderCount',
            'customer',
            'totalProducts',
            'totalBrands',
            'orderChange',
            'customerChange',
            'productChange',
            'brandChange',
            'recentOrders'
        ));
    }
    
    private function calculatePercentageChange($previous, $current) {
        if ($previous == 0) return 0;
        return (($current - $previous) / $previous) * 100;
    }

}
