<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Validator;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Order;
use App\Models\User;
use App\Models\Orders_products;
use App\Models\Review;
use App\Models\Product;
use App\Models\Notifications;
use App\Models\Task;

class AdminController extends Controller
{
    public function index(){
        $orders = Order::where('status', 'Pending')->get();
        $users = User::whereDate('created_at', '>', \carbon\Carbon::now()->subDays(30))->get();
        $reviews = Review::where('status', 'Pending')->get();
        $nots = Notifications::all();
        $tasks = Task::all();
        return view('admin.home', compact('orders', 'users', 'reviews', 'nots', 'tasks')); 
    } 

    public function getCats() {
        $data = Category::all();
        return response()->json(['cats' => $data]);
    }  

    public function getBrands() {
        $data = Brand::all();
        return response()->json(['brands' => $data]);
    } 

    /*
    |----------------------------
    |---------- Profile ---------
    |----------------------------
    */

    public function profile(){
        $user = User::whereId(Auth::user()->id)->first();
        return view('admin.users.profile', compact('user')); 
    } 
    public function profilePost(Request $request) { 
        $old_image = $request->hidden_image; //old photo 
        $image = $request->file('image'); // new photo
        $rules = array(
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'    => 'required|numeric',
            'country'  => 'required',
            'state'    => 'required',
            'city'     => 'required',
            'image'    => 'mimes:jpeg,jpg,png,gif|max:2048'
        );
        $currentEmail = Auth::user()->email;
        if($request->email == $currentEmail) $rules['email'] = ['required', 'string', 'email', 'max:255'];
        if($request->mobile) $rules['mobile'] = ['numeric'];

        $this->validate(request(),$rules);

        $form_data = array(
            'name'     =>  $request->name,
            'email'    =>  $request->email,
            'phone'    =>  $request->phone,
            'country'  =>  $request->Country_ID,
            'state'    =>  $request->State_ID,
            'city'     =>  $request->City_ID,
            'mobile'   =>  $request->mobile,
        );
        if($request->password) $form_data['password'] = Hash::make($request['password']);

        //upload photo
        if($image){ 
            $oldPhoto = public_path().'/storage/images/users/'.$old_image;
            if(File::exists($oldPhoto)) File::delete($oldPhoto);

            $new_name = 'user_'.$request->email.'_'.rand().'.'. $image->getClientOriginalExtension();
            $image->move(public_path('storage/images/users'), $new_name);
            $form_data['image'] = $new_name;
        }

        User::whereId(Auth::user()->id)->update($form_data);
    
        session() -> flash('success','Yor information has been updated!');
        return back();
    } 

}
