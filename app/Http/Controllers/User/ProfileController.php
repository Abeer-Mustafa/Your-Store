<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class ProfileController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }
    
    // View Profile Page
    public function profile() { 
        $user = User::find(Auth::user()->id);
        return view('front.profile',compact('user')); 
    }      

    // View Edit Profile Page
    public function editProfile() { 
        $user = User::find(Auth::user()->id);
        return view('front.editprofile',compact('user')); 
    }     

    // View Edit Profile Page
    public function postProfile(Request $request) { 
        $old_image = $request->hidden_image; //old photo 
        $image = $request->file('image'); // new photo
        $rules = array(
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'    => 'required',
            'country'  => 'required',
            'state'    => 'required',
            'city'     => 'required',
            'image'    => 'mimes:jpeg,jpg,png,gif|max:2048'
        );
        $currentEmail = Auth::user()->email;
        if($request->email == $currentEmail) $rules['email'] = ['required', 'string', 'email', 'max:255'];

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
        session() -> flash('success',__('controller.InformationUpdated'));
        return back();
    }  
}
