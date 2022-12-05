<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Validator;

use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()
                    ->of(Brand::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm" style="margin-bottom: 2px;">'. __('dashboard.Edit') .'</button>';
                        $button .= '&nbsp; &nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">'. __('dashboard.Delete') .'</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.brands');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name'        => 'required|unique:brands',
            'image'       => 'mimes:jpeg,jpg,png,gif|required|max:2048'
        );        

        $form_data = array(
            'name'        =>  $request->name,
            'image'       =>  $request->image
        );
        $specialChars = [ '*', '/', '+', '-', ' ', '=', ')', '(', '&', '^', '%', '$', '#', '@',
                        '!', '~', '`', '÷', '×', '؛', '<', '>', '"', ':', ',', '|', '\\', '.', '؟', 
                        '?', '[', '{', ']', '}' ];

        if($request->action == 'Add'){
            $error = Validator::make($request->all(), $rules);
            if($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $image = $request->file('image');
            $imageSpace = trim(str_replace($specialChars, '', $request->name));
            $new_name = 'brands_'.$imageSpace.'_'.rand().'.'. $image->getClientOriginalExtension();
            $form_data['image'] = $new_name;
            $image->move(public_path('/storage/images/brands'), $new_name);

            $product = Brand::create($form_data);
            return response()->json(['success' => __('controller.dashAddBrand', ['attribute' =>$request->name]) ]);
        }

        else{
            $old_image = $request->hidden_image;
            $new_image = $request->file('image');
            if($request->old_name == $request->name) $rules['name'] = '';
            //upload photo
            if($new_image != ''){
                $error = Validator::make($request->all(), $rules);
                if($error->fails()) {
                    return response()->json(['errors' => $error->errors()->all()]);
                }

                $oldPhoto = public_path().'/storage/images/brands/'.$old_image;
                if(File::exists($oldPhoto))
                    File::delete($oldPhoto);

                $imageSpace = trim(str_replace($specialChars, '', $request->name));
                $new_name = 'brands_'.$imageSpace.'_'.rand().'.'. $new_image->getClientOriginalExtension();
                $new_image->move(public_path('/storage/images/brands'), $new_name);
                $form_data['image'] = $new_name;
            }
            else {
                $rules['image'] = '';
                $error = Validator::make($request->all(), $rules);
                if($error->fails()) {
                    return response()->json(['errors' => $error->errors()->all()]);
                }
                $form_data['image'] = $old_image;
            }
         
            Brand::whereId($request->hidden_id)->update($form_data);
            return response()->json(['success' => __('controller.dashEditBrand', ['attribute' =>$request->name]) ]);
        }
    }

    public function edit($id)
    {
        if(request()->ajax()){
            $data = Brand::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function destroy($id){
        $data = Brand::findOrFail($id);
        $image = public_path().'/storage/images/brands/'.$data->image;
        if(File::exists($image))  File::delete($image);
        $data->delete();
    }
}