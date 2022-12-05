<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Product;

class CartPageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    // View Cart Content Page
    public function cart() { 
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('front.cart', compact('cart')); 
    } 

    // remove item from Cart Page
    public function cartDelete() { 
        $item_id = $_POST['item_id'];
        Cart::findOrFail($item_id)->delete();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $items_count = 0;
        foreach ($cart as $item) {
            $pro_stock = Product::whereId($item->product_id)->first()->stock;
            $cart_stock = $item->quantity;
            $cur_stock = min($pro_stock, $cart_stock);
            $items_count += $cur_stock;
        }
         
        return response()->json([
            'success' => __('controller.SuccessEditCart', ['attribute' => Auth::user()->name]),
            'count'=> $items_count,
            ]);
    }     

    // Update item in Cart Page
    public function cartModify() { 
        $item_id = $_POST['item_id'];
        $quantity = $_POST['quantity'];
        $item_info = Cart::where('id', $item_id)->first();
        $pro_info = Product::where('id', $item_info->product_id)->first();
        $curr_quantity = $pro_info->stock;
        if($curr_quantity < $quantity) return response()->json(['error'=> __('controller.ErrorUpdateCart', ['attribute' => $curr_quantity]) ]);
        $cart = Cart::whereId($item_id)->update(['quantity'=> $quantity]);
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $items_count = 0;
        foreach ($cart as $item) {
            $pro_stock = Product::whereId($item->product_id)->first()->stock;
            $cart_stock = $item->quantity;
            $cur_stock = min($pro_stock, $cart_stock);
            $items_count += $cur_stock;
        }
        return response()->json([
            'success' => __('controller.SuccessEditCart', ['attribute' => Auth::user()->name]),
            'count'=> $items_count,
            'abeer'=> $item_id.' '.$quantity.' '.$curr_quantity,
            ]);
    } 

    // Update Cart Page
    public function cartUpdate() { 
       $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('front.layouts.cart', compact('cart')); 
    } 
}
