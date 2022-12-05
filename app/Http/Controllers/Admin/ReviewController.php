<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

use App\Models\Review;
use App\Models\Product;
use App\Models\User;

class ReviewController extends Controller
{
    // view reviews page
    public function reviews() {
        $reviews = Review::all();
        return view('admin.reviews', compact('reviews'));
    }  
    // view all reviews | update table
    public function all_reviews() {
        $reviews = Review::all();
        return view('admin.layouts.reviews', compact('reviews'));
    }  
    // view pending reviews | update table
    public function pending_reviews() {
        $reviews = Review::where('status', 'Pending')->get();
        return view('admin.layouts.reviews', compact('reviews'));
    }  
    // view delivered reviews | update table
    public function accepted_reviews() {
        $reviews = Review::where('status', 'Accepted')->get();
        return view('admin.layouts.reviews', compact('reviews'));
    } 
    // change status
    public function accepted() {
        $record_id = $_GET['record_id'];
        Review::whereId($record_id)->update(['status'=>'Accepted']);

        $review = Review::whereId($record_id)->first();
        $reviews = Review::where([['product_id', $review->product_id],['status', 'Accepted'] ])->get();
        $ratting = 0;
        foreach ($reviews as $review) $ratting += $review->stars;
        $ratting /= count($reviews);
        $pro = Product::where('id', $review->product_id)->update(['rating' => $ratting]);

        return response()->json(['success' => $record_id]);
    }  
    // delete review
    public function delete_review() {
        $record_id = $_GET['record_id'];
        $review = Review::whereId($record_id)->first();
        Review::whereId($record_id)->delete();
        if($review->status =='Accepted'){
            $reviews = Review::where([['product_id', $review->product_id],['status', 'Accepted'] ])->get();
            $ratting = 0;
            foreach ($reviews as $review) $ratting += $review->stars;
            $ratting /= count($reviews);
            $pro = Product::where('id', $review->product_id)->update(['rating' => $ratting]);
        }
        return response()->json(['success' => $record_id]);
    } 
    // view user information
    public function view_rater($user_id) {
        $user = User::whereId($user_id)->first();
        return view('admin.layouts.reviews_info_user', compact('user'));
    } 
    // view product information
    public function view_pro($pro_id) {
        $pro = Product::whereId($pro_id)->first();
        return view('admin.layouts.reviews_info_pro', compact('pro'));
    } 
}
