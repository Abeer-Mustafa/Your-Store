<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;

class CategoryController extends Controller
{

    // Show Category Page
    public function category($cat_id) {
        $cat = Category::where('id', $cat_id)->first();
        $products = getProducts($cat_id);
        $products = getUniqueProCat($products);
        
        $attr = getAttrProCat($products);
        $brands = $attr[0];
        $colors = $attr[1];
        $sizes = $attr[2];
        $minPrice = $attr[3];
        $maxPrice = $attr[4];
        $products = paginate($products);
        $products->withPath($cat_id);
        $childrenCats = \App\Models\Category::where('parent_id', $cat_id)->get();

        return view('front.category', compact('cat', 'childrenCats', 'products', 'brands', 'colors', 'sizes', 'minPrice', 'maxPrice')); 
    }   

 	// Filter | Return Products by mainCat and/or color and/or size and/or brand
    public function returnProducts($mainCat, $brand, $color, $size, $min_price, $max_price) {
        $products = getProducts($mainCat);
        $products = getUniqueProCat($products);
        $allproducts = [];
	    if($brand!=0){
	        foreach ($products as $key => $pro)
	            if($products[$key]['brand_id'] == $brand) array_push($allproducts, $products[$key]);
           $products = $allproducts;
           $allproducts = [];
        } 

        if(count($color)>0){
            foreach ($products as $key => $pro)
                if(in_array($products[$key]['color'], $color)) array_push($allproducts, $products[$key]);
           $products = $allproducts;
           $allproducts = [];
        }

        if(count($size)>0){
            foreach ($products as $key => $pro)
                if(in_array($products[$key]['size'], $size)) array_push($allproducts, $products[$key]);
           $products = $allproducts;
           $allproducts = [];
        } 

        foreach ($products as $key => $pro)
            if($products[$key]['price'] >= $min_price && $products[$key]['price'] <= $max_price) array_push($allproducts, $products[$key]);
        $products = $allproducts;
        $allproducts = [];
        return $products;
    }  

    // Update Every thing in category page | json response
    public function updateEveryThing(Request $request) {
        $mainCat = $request->mainCat;
        $brand = $request->brandValue;
        $limit = $request->limit;
        $sort = $request->sort;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $color = colores($request);
        $size = sizes($request);
        $allProducts = $this->returnProducts($mainCat, $brand, $color, $size, $min_price, $max_price);
        $productss = sortpros($sort, $allProducts, $limit);
        $productss = paginate($productss);
        $productss->withPath($mainCat);
        session()->put('product_data', $productss);
        return response()->json([
            'success' => [$productss]
        ]);
    }

    // Show All Categories Page
    public function allCats(){
        return view('front.categories');
    }
}
