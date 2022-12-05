<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use Validator;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(User::where('id', '!=', Auth::user()->id)->latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">'. __('dashboard.Edit') .'</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">'. __('dashboard.Delete').'</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.users.index');
    }

 
    public function store(Request $request)
    {
        $rules = array(
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone'    => 'required',
            'country'  => 'required',
            'state'    => 'required',
            'city'     => 'required',
            'image'    => 'mimes:jpeg,jpg,png,gif|max:2048'
        );

        $error = Validator::make($request->all(), $rules);
        if($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $data = array(
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'country'  => $request->country,
            'state'    => $request->state,
            'city'     => $request->city,
            'password' => Hash::make($request['password']),
            'image'    => '',
        );

        if($request->file('image')){
            $image = $request->file('image');
            $new_name = 'user_'.$request->email.'_'.rand().'.'. $image->getClientOriginalExtension();
            $image->move(public_path('/storage/images/users'), $new_name);
            $data['image'] = $new_name;
        }
        $user = User::create($data);

        return response()->json(['success' => __('controller.dashAddUser', ['attribute' => $request->name])]);
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = User::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $image_name = $request->hidden_image; //old photo 
        // $image = $request->file('image'); // new photo
        $rules = array(
            'name'     =>  'required|string|max:255',
            'email'    =>  'required|string|email|max:255|unique:users',
            'phone'    =>  'required',
            'country'  =>  'required',
            'state'    =>  'required',
            'city'     =>  'required',
            'image'    =>  'mimes:jpeg,jpg,png,gif|max:2048',
        );
        $form_data = array(
            'name'     =>  $request->name,
            'email'    =>  $request->email,
            'phone'    =>  $request->phone,
            'country'  =>  $request->country,
            'state'    =>  $request->state,
            'city'     =>  $request->city,
            'admin'    =>  $request->admin,
        );
        //upload photo
        if($request->file('image')){ 
            $image_name = $request->hidden_image; //old photo 
            $image = $request->file('image'); // new photo

            if($request->old_email == $request->email) $rules['email'] = '';
            $error = Validator::make($request->all(), $rules);
            if($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $oldPhoto = public_path().'/storage/images/users/'.$image_name;
            if(File::exists($oldPhoto)) {
                File::delete($oldPhoto);
            }

            $new_name = 'user_'.$request->email.'_'.rand().'.'. $image->getClientOriginalExtension();
            $image->move(public_path('/storage/images/users'), $new_name);
            $form_data['image'] = $new_name;
        }
        else {
            // $rules['image'] = '';
            if($request->old_email == $request->email) $rules['email'] = '';
            $error = Validator::make($request->all(), $rules);
            if($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }
     
        User::whereId($request->hidden_id)->update($form_data);
        
        return response()->json(['success' => __('controller.dashEditUser', ['attribute' => $request->name])]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $image = public_path().'/storage/images/users/'.$data->image;
        if(File::exists($image))  File::delete($image);
        $data->delete();
    }
}