<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Brand;
use App\Models\Product;

class BrandController extends Controller
{
    // Show Brand Page
    public function brand($brand_id){
        $brand = Brand::where('id', $brand_id)->first();
        $products = Product::where('brand_id', $brand_id)->get();
        $products = getUniqueProBrand($products)->all();

        $attr = getAttrProBrand($products);
        $cats = $attr[0];
        $colors = $attr[1];
        $sizes = $attr[2];
        $minPrice = $attr[3];
        $maxPrice = $attr[4];
        $products = paginate($products);
        $products->withPath($brand_id);
        return view('front.brand', compact('brand', 'products', 'cats', 'colors', 'sizes', 'minPrice', 'maxPrice')); 
    }
    
    // Filter | Return Products by Brand and/or color and/or size and/or category
    public function returnProductsBrand($mainBrand, $Cat, $color, $size, $min_price, $max_price) {
        $products = Product::where('brand_id', $mainBrand)->get();
        $products = getUniqueProBrand($products)->all();
        $allproducts = [];
        if($Cat!=0){
            foreach ($products as $key => $pro)
                if($pro->cat_id == $Cat) array_push($allproducts, $products[$key]);
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

    // Update Every thing in Brand page | json response
    public function updateEveryThingBrand(Request $request) {
        $mainBrand = $request->mainBrand;
        $Cat = $request->cat;
        $limit = $request->limit;
        $sort = $request->sort;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $color = colores($request);
        $size = sizes($request);
        $allProducts = $this->returnProductsBrand($mainBrand, $Cat, $color, $size, $min_price, $max_price);
        $productss = sortpros($sort, $allProducts, $limit);
        $productss = paginate($productss);
        $productss->withPath($mainBrand);
        session()->put('product_data', $productss);
        return response()->json([
            'success' => [$productss]
        ]);
    }
   
    // Show All Brands Page
    public function allBrands(){
        return view('front.brands');
    } 
}
