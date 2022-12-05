<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()
                    ->of(Category::latest()->get())
                    ->addColumn('action', function($data){
                        // $button = '<button type="button" id="'.$data->id.'" class="viewProducts btn btn-warning btn-sm">View Products</button>';
                        // $button .= '&nbsp;&nbsp;';
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">'. __('dashboard.Edit') .'</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">'. __('dashboard.Delete') .'</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.categories');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name'         => 'required|string|max:255',
            'description'  => 'required',
            'parent_id'    => 'required',
            'image'        => 'mimes:jpeg,jpg,png,gif|required|max:2048'
        );

        if($request->parent_id > 0)$parent_name = Category::findOrFail($request->parent_id)->name;
        else $parent_name = 'Main Category';

        $form_data = array(
            'name'        =>  $request->name,
            'description' =>  $request->description,
            'parent_id'   =>  $request->parent_id,
            'parent_name' =>  $parent_name,
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
            $new_name = 'cats_'.$imageSpace.'_'.rand().'.'. $image->getClientOriginalExtension();
            $form_data['image'] = $new_name;
            $image->move(public_path('/storage/images/cats'), $new_name);
 
            $cat = Category::create($form_data);
            return response()->json(['success' => __('controller.dashAddCat', ['attribute' => $cat->name]), 'name' => $cat->name, 'id' => $cat->id ]);
        }

        else{
            $old_image = $request->hidden_image;
            $new_image = $request->file('image');
            //upload photo
            if($new_image != ''){
                $error = Validator::make($request->all(), $rules);
                if($error->fails()) {
                    return response()->json(['errors' => $error->errors()->all()]);
                }

                $oldPhoto = public_path().'/storage/images/cats/'.$old_image;
                if(File::exists($oldPhoto))
                    File::delete($oldPhoto);

                $imageSpace = trim(str_replace($specialChars, '', $request->name));
                $new_name = 'cats_'.$imageSpace.'_'.rand().'.'. $new_image->getClientOriginalExtension();
                $new_image->move(public_path('/storage/images/cats'), $new_name);
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
         
            Category::whereId($request->hidden_id)->update($form_data);
            return response()->json(['success' => __('controller.dashEditCat', ['attribute' => $request->name])]);
        }

    }


    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Category::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function destroy($id)
    {
        $data = Category::findOrFail($id);
        $image = public_path().'/storage/images/cats/'.$data->image;
        if(File::exists($image))  File::delete($image);
        $data->delete();
    }
}
