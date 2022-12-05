<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Recommendation;

class CartController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    // Add Item to Cart in product page
    public function cart($product_id) {
        $pro_info = Product::where('id', $product_id)->first();
        
        // Validate
        $rules = $this->validatePro(request(), $pro_info, 'color', 'size', 'quantity');
        
        //Errors
        if($rules) return response()->json(['error' => $rules]);

        // Success
        $pro_cart_info = $this->insertItem(request(), $pro_info, 'color', 'size', 'quantity');
      
        // get new total number of items in cart
        $items_count = $this->newTotalCart();

        // Recommendation
        recommndations($pro_cart_info);

        // Return response
        return response()->json([
            'notification' => __('controller.SuccessAddedToCart', ['attribute' => $pro_cart_info->name]),
            'success' => __('controller.SuccessAddedToCart', ['attribute' => $pro_cart_info->name]),
            'total' => $items_count,
            'items_count' => $items_count 
        ]);
    } 

    // Remove Item from Cart
    public function removeItem($item_id){
        $item = Cart::where('id', $item_id)->first();
        $product = Product::where('id', $item->product_id)->first();

        $discount = $product->discount * $product->price /100;
        $price = ($product->price - $discount ) * $item->quantity ;
        
        $item->delete();

        // get new total number of items in cart
        $items_count = $this->newTotalCart();

        return response()->json(['price'=> $price, 'count'=> $items_count]);
    }

    public function cartContent(){
        return view('front.layouts.content_cart');
    }   

    // Add Item to Cart in Home Page
    public function cartHome($product_id) {
        $pro_info = Product::where('id', $product_id)->first();
        
        // Validate
        $rules = $this->validatePro(request(), $pro_info, 'color_'.$product_id, 'size_'.$product_id, 'quantity_'.$product_id);
        
        // Errors
        if($rules) return response()->json(['error' => $rules]);
        
        // Success
        $pro_cart_info = $this->insertItem(request(), $pro_info, 'color_'.$product_id, 'size_'.$product_id, 'quantity_'.$product_id);
       
        // get new total number of items in cart
        $items_count = $this->newTotalCart();

        // Recommendation
        recommndations($pro_cart_info);

       // Return response
        return response()->json([
            'notification' => __('controller.SuccessAddedToCart', ['attribute' => $pro_cart_info->name]),
            'success' => __('controller.SuccessAddedToCart', ['attribute' => $pro_cart_info->name]),
            'total' => $items_count,
            'items_count' => $items_count
        ]);
    } 

    // Add to wish list
    public function AddToWish($product_id){
        $pro = Product::where('id', $product_id)->first();
        $cart = Wishlist::create([
            'user_id'    =>  Auth::user()->id,
            'product_id' =>  $product_id,
        ]);
        
        // Recommendation
        recommndations($pro);

        return response()->json(['success' => __('controller.SuccessAddedToWish', ['attribute' => $pro->name])]);
    }

    /*
    | -------------------------------------
    | --------- Helpers Functions ---------
    | -------------------------------------
    */
    public function validatePro($request, $pro_info, $color_class, $size_class, $qty_class){
        $rules = array(
            'color'    =>  '',
            'size'     =>  '',
            'quantity' =>  '',
        );
        // Validation color | Size
        if($pro_info->color && !request()->$color_class) $rules['color'] = __('controller.Color required!');
        if($pro_info->size && !request()->$size_class) $rules['size'] = __('controller.Size required!');
        if($rules['color'] || $rules['size']) {
            return $rules;
        }

        // Validation Quantity
        $curr_quantity = $pro_info->stock;
        if($pro_info->size && $pro_info->color) 
            $curr_quantity = Product::where([
                ['code', '=', $pro_info->code],
                ['color', '=', request()->$color_class],
                ['size', '=', request()->$size_class],
            ])->first()->stock;

        else if($pro_info->size && !$pro_info->color) 
            $curr_quantity = Product::where([
                ['code', '=', $pro_info->code],
                ['size', '=', request()->$size_class]
            ])->first()->stock;     

        else if(!$pro_info->size && $pro_info->color) 
            $curr_quantity = Product::where([
                ['code', '=', $pro_info->code],
                ['color', '=', request()->$color_class]
            ])->first()->stock;

        if($curr_quantity < request()->$qty_class) $rules['quantity'] = __('controller.NO_Qty', ['attribute' => $curr_quantity]);
        
        if($rules['quantity']) {
            return $rules;
        }
    }   

    public function insertItem($request, $pro_info, $color_class, $size_class, $qty_class){
        $form_data = array(
            'user_id'    =>  Auth::user()->id,
            'product_id' =>  $pro_info->id,
            'quantity'   =>  request()->$qty_class,
        );

        $product_code = $pro_info->code;
        if($pro_info->color && $pro_info->size)
            $pro_cart_info = Product::where([
                ['code', $product_code],
                ['color', request()->$color_class],
                ['size', request()->$size_class]
            ])->first();      
        else if($pro_info->color)
            $pro_cart_info = Product::where([
                ['code', $product_code],
                ['color', request()->$color_class]
            ])->first();
        else if($pro_info->size)
            $pro_cart_info = Product::where([
                ['code', $product_code],
                ['size', request()->$size_class]
            ])->first();
        else $pro_cart_info = $pro_info;

        $form_data['product_id'] = $pro_cart_info->id;
        $cart = Cart::create($form_data);
        return $pro_cart_info;
    }

    public function newTotalCart(){
        $items_cart = Cart::where('user_id', Auth::user()->id)->get();
        $items_count = 0;
        foreach ($items_cart as $item) {
            $pro_stock = Product::whereId($item->product_id)->first()->stock;
            $cart_stock = $item->quantity;
            $cur_stock = min($pro_stock, $cart_stock);
            $items_count += $cur_stock;
        }
        return $items_count;
    }

}
