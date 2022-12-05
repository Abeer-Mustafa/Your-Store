<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Orders_products;
use App\Models\Order;

class OrdersController extends Controller
{

	public function __construct() {
        $this->middleware('auth');
    }

    // View Orders Page
    public function orders() { 
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('front.orders',compact('orders')); 
    }    

    // View Order Information Page
    public function orderPage($order_id) { 
        $order = Orders_products::where('order_id', $order_id)->get();
        return view('front.order_page',compact('order')); 
    }
}
