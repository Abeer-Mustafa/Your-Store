<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Recommendation;

class ProductController extends Controller
{
    // Show Product Page
    public function product($product_id) {
        $product = Product::where('id', $product_id)->first();
        // You might also like
        if(Auth::guest()){
            $might_like = [];
            if(session()->has('footer_might_like')) $might_like = session()->get('footer_might_like');
            $footer_code = Product::where([['code', $product->code], ['id', '!=',$product_id] ])->get();
            $footer_cat = Product::where([['cat_id', $product->cat_id], ['id', '!=',$product_id] ])->get();
            $footer_might_like = $footer_cat->merge($footer_code);
            $footer_might_like = $footer_might_like->merge($might_like)->take(10);
            session()->put('footer_might_like', $footer_might_like);
        }
        
        // Recommendation
        else recommndations($product);

        return view('front.product', compact('product')); 
    }  

    // Filter | Return Products by Brand and/or color and/or size and/or category
    public function returnProductsAll($cat, $brand, $color, $size, $min_price, $max_price) {
        $products = Product::all();
        $products = getUniqueProBrand($products)->all();

        $allproducts = [];
        if($cat!=0){
            foreach ($products as $key => $pro)
                if($pro->cat_id == $cat) array_push($allproducts, $products[$key]);
           $products = $allproducts;
           $allproducts = [];
        }  
         
        if($brand!=0){
            foreach ($products as $key => $pro)
                if($pro->brand_id == $brand) array_push($allproducts, $products[$key]);
           $products = $allproducts;
           $allproducts = [];
        } 

        if(count($color)>0){
            foreach ($products as $key => $pro)
                if(in_array($pro->color, $color)) array_push($allproducts, $products[$key]);
           $products = $allproducts;
           $allproducts = [];
        }

        if(count($size)>0){
            foreach ($products as $key => $pro)
                if(in_array($pro->size, $size)) array_push($allproducts, $products[$key]);
           $products = $allproducts;
           $allproducts = [];
        } 

        foreach ($products as $key => $pro)
            if($pro->price >= $min_price && $pro->price <= $max_price) array_push($allproducts, $products[$key]);
        $products = $allproducts;
        $allproducts = [];

        return $products;
    }   

    // Update Every thing in Product page | json response
    public function updateEveryThingProducts(Request $request) {
        $cat = $request->cat;
        $brand = $request->brand;
        $limit = $request->limit;
        $sort = $request->sort;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $color = colores($request);
        $size = sizes($request);
        $allProducts = $this->returnProductsAll($cat, $brand, $color, $size, $min_price, $max_price);
        $productss = sortpros($sort, $allProducts, $limit);
        $productss = paginate($productss);
        $productss->withPath('products');
        session()->put('product_data', $productss);
        return response()->json([
            'success' => [$productss]
        ]);
    }

    // Show All Products Page
    public function allProducts(){
        $products = Product::all();
        $products = getUniqueProBrand($products)->all();

		$attr = getAttrPros($products);
        $cats = $attr[0];
        $brands = $attr[1];
        $colors = $attr[2];
        $sizes = $attr[3];
        $minPrice = $attr[4];
        $maxPrice = $attr[5];
        $products = paginate($products);
        $products->withPath('products');
        return view('front.all_products', compact('products', 'brands', 'cats', 'colors', 'sizes', 'minPrice', 'maxPrice')); 
    }  

}
