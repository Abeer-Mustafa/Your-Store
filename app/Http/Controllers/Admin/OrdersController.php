<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Orders_products;
use App\Models\User;

class OrdersController extends Controller
{
    // view orders page
    public function orders() {
        $orders = Order::all();
        return view('admin.orders', compact('orders'));
    }   
    // view all orders | update table
    public function all_orders() {
        $orders = Order::all();
        return view('admin.layouts.orders', compact('orders'));
    }  
    // view pending orders | update table
    public function pending_orders() {
        $orders = Order::where('status', 'Pending')->get();
        return view('admin.layouts.orders', compact('orders'));
    }  
    // view delivered orders | update table
    public function delivered_orders() {
        $orders = Order::where('status', 'Delivered')->get();
        return view('admin.layouts.orders', compact('orders'));
    } 
    // change status
    public function delivered() {
        $order = $_GET['record_id'];
        Order::whereId($order)->update(['status'=>'Delivered']);
        return response()->json(['success' => $order]);
    }  
    // delete order
    public function delete_order() {
        $order = $_GET['record_id'];
        Order::findOrFail($order)->delete();
        return response()->json(['success' => $order]);
    } 
    // view user information
    public function view_user($user_id) {
        $info = User::whereId($user_id)->get();
        return view('admin.layouts.orders_info_user', compact('info'));
    } 
    // view order information
    public function view_order($order_id) {
        $info = Orders_products::where('order_id', $order_id)->get();
        return view('admin.layouts.orders_info_order', compact('info'));
    } 
}
