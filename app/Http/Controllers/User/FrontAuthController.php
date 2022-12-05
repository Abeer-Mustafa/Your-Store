<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use Stripe;

use App\Models\Review;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Notifications;
use App\Models\Orders_products;
use App\Models\User;

class FrontAuthController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    // Add Review on Product
    public function review($product_id) {
        $rules = array(
            'feedback' => 'required',
            'rating'   => 'required'
        );        

        $niceName = array(
            'feedback' => 'Feedback',
            'rating'   => 'Rating'
        );

        $form_data = array(
            'user_id'    =>  Auth::user()->id,
            'product_id' =>  $product_id,
            'feedback'   =>  request()->feedback,
            'stars'      =>  request()->rating,
        );

        // $error = Validator::make(request()->all(), $rules, [], $niceName);
        $error = Validator::make(request()->all(), $rules);
        if($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $review = Review::create($form_data);
        return response()->json(['success' => __('controller.SuccessAddReview', ['attribute' => Auth::user()->name]) ]);
    } 
    
    /*
    |----------------------------------
    |---------- Checkout page ---------
    |----------------------------------
    */
    public function checkout() { 
       $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('front.checkout', compact('cart')); 
    } 

    public function stripePost(Request $request) {
        \Stripe\Stripe::setApiKey ( env('STRIPE_SECRET') );
        if($request->totalPriceDollar == 0){
            Session::flash( 'fail-message', __('controller.ErrorCartEmpty') );
            return back();
        }
        try {
    
            //create customer
            $user = Auth::user();
            $options = [
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'address' => [
                    'country' => $user->country,
                    'state' => $user->state,
                    'line1' => $user->city,
                ]
            ];
            $custmer = \Stripe\Customer::create($options);
            // charge
            $charge = \Stripe\Charge::create([
                "amount" => $request->totalPriceDollar * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Custom descriptor." ,
                'statement_descriptor' => 'Custom descriptor',
            ]);

            Session::flash( 'success-message', __('controller.PaymentDone') );

            $order = Order::create([
                'status' => 'Pending',
                'user_id' => Auth::user()->id,
                'payment_amount' => $request->totalPriceDollar
            ]); 
            $products = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($products as $pro) {
                $product = Product::whereId($pro->product_id)->first();
                $pro_stock = $product->stock;
                $cart_stock = $pro->quantity;
                $cur_stock = min($pro_stock, $cart_stock);
                if($pro_stock){
                    Orders_products::create([
                        'order_id' => $order->id,
                        'product_id' => $pro->product_id,
                        'qty' => $cur_stock,
                    ]);
                    $new_stock = $pro_stock - $cur_stock;
                    Product::whereId($pro->product_id)->update(['stock' => $new_stock]);
                    // if qty<=10 let admin know that!
                    if($new_stock <= 10)
                        Notifications::create(['product_id'=>$pro->product_id, 'qty'=>$new_stock]);
                }
            }
            return back();
        } 
    
        catch(\Stripe\Exception\CardException $e) {
            // Since it's a decline, \Stripe\Exception\CardException will be caught
            Session::flash( 'fail-message', 
                'Status is:' . $e->getHttpStatus() . '\n'.
                'Type is:' . $e->getError()->type . '\n'.
                'Code is:' . $e->getError()->code . '\n'.
                'Param is:' . $e->getError()->param . '\n'.
                'Message is:' . $e->getError()->message . '\n'
            );
            return back();
        } 
        catch (\Stripe\Exception\RateLimitException $e) {
            Session::flash( 'fail-message', "Error! ".$e->getError()->message );
            return back();
        } 
        catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            Session::flash( 'fail-message', "Error! ".$e->getError()->message );
            return back();
        } 
        catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            Session::flash( 'fail-message', "Error! ".$e->getError()->message );
            return back();            
        } 
        catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            Session::flash( 'fail-message', "Error! ".$e->getError()->message );
            return back();  
        } 
        catch (\Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            Session::flash( 'fail-message', "Error! ". $e->getError()->message );
            return back();  
        }
        catch ( \Exception $e ) {
            Session::flash( 'fail-message',  __('controller.ErrorTryAgain') );
            return back();
        }
    }

}
