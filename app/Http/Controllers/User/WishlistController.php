<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    // View Wishlist Page
    public function wishlist() { 
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
        return view('front.wishlist', compact('wishlist')); 
    }       

    // remove item from Wishlist
    public function wishlistModify() { 
        $item_id = $_POST['item_id'];
        Wishlist::findOrFail($item_id)->delete();
        return response()->json(['success'=> __('controller.SuccessEditWish', ['attribute' => Auth::user()->name]) ]);
    }     

    // Update Wishlist
    public function wishUpdate() { 
       $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
        return view('front.layouts.wishlist', compact('wishlist')); 
    } 

}
