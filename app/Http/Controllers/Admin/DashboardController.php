<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Collect simple statistics for the dashboard cards
        $stats = [
            'total_products'  => Product::count(),
            'total_orders'    => Order::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'pending_orders'  => Order::where('status', 'pending')->count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
        ];

        // Latest 5 orders to show in the recent orders table
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}