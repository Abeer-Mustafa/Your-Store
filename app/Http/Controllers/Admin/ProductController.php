<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Validator;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()
                    ->of(Product::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm" style="margin-bottom: 2px;">'. __('dashboard.Edit') .'</button>';
                        $button .= '<br/>';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">'. __('dashboard.Delete') .'</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.products');
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = array(
            'name'        => 'required|string|max:255',
            'code'        => 'required',
            'cat_id'      => 'required',
            'brand_id'    => 'required',
            'stock'       => 'required|numeric|min:1',
            'price'       => 'required|numeric|min:0',
            'description' => 'required',
            'discount'    => '',
            'image'       => 'mimes:jpeg,jpg,png,gif|required|max:2048'
        );        

        $form_data = array(
            'name'        =>  $request->name,
            'code'        =>  $request->code,
            'cat_id'      =>  $request->cat_id,
            'brand_id'    =>  $request->brand_id,
            'stock'       =>  $request->stock,
            'price'       =>  $request->price,
            'color'       =>  $request->color,
            'size'        =>  $request->size,
            'more_info'   =>  $request->more_info,
            'description' =>  $request->description,
            'image'       =>  $request->image,
            'discount'    =>  0
        );
        $specialChars = [ '*', '/', '+', '-', ' ', '=', ')', '(', '&', '^', '%', '$', '#', '@',
                '!', '~', '`', '÷', '×', '؛', '<', '>', '"', ':', ',', '|', '\\', '.', '؟', 
                '?', '[', '{', ']', '}' ];

        if($request->action == 'Add'){
            if($request->discount){ $rules['discount']='numeric'; $form_data['discount']=$request->discount; }
            $error = Validator::make($request->all(), $rules);
            if($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $image = $request->file('image');
            $imageSpace = trim(str_replace($specialChars, '', $request->name));
            $new_name = 'products_'.$imageSpace.'_'.rand().'.'. $image->getClientOriginalExtension();
            $form_data['image'] = $new_name;
            $image->move(public_path('/storage/images/products'), $new_name);

            $product = Product::create($form_data);
            return response()->json(['success' =>  __('controller.dashAddPro', ['attribute' =>$request->name]) ]);
        }

        else{
            if($request->discount){ $rules['discount']='numeric'; $form_data['discount']=$request->discount; }
            $old_image = $request->hidden_image;
            $new_image = $request->file('image');
            //upload photo
            if($new_image != ''){
                $error = Validator::make($request->all(), $rules);
                if($error->fails()) {
                    return response()->json(['errors' => $error->errors()->all()]);
                }

                $oldPhoto = public_path().'/storage/images/products/'.$old_image;
                if(File::exists($oldPhoto))
                    File::delete($oldPhoto);

                $imageSpace = trim(str_replace($specialChars, '', $request->name));
                $new_name = 'products_'.$imageSpace.'_'.rand().'.'. $new_image->getClientOriginalExtension();
                $new_image->move(public_path('/storage/images/products'), $new_name);
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
         
            Product::whereId($request->hidden_id)->update($form_data);
            return response()->json(['success' => __('controller.dashEditPro', ['attribute' =>$request->name]) ]);
        }
    }

    public function edit($id)
    {
        if(request()->ajax()){
            $data = Product::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function destroy($id){
        $data = Product::findOrFail($id);
        $image = public_path().'/storage/images/products/'.$data->image;
        if(File::exists($image))  File::delete($image);
        $data->delete();
    }
}
