<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;

class FiltersController extends Controller
{

    // Get Products from session
    public function updateProducts() {
        $products = session()->get('product_data');
        return view('front.layouts.updateProducts', compact('products'));
    } 

    // View Search Page
    public function search($input) { 
        $products = getSearcheRes(strtoupper($input));
       
        $attr = getAttrPros($products);
        $cats = $attr[0];
        $brands = $attr[1];
        $colors = $attr[2];
        $sizes = $attr[3];
        $minPrice = $attr[4];
        $maxPrice = $attr[5];
        return view('front.search', compact('input', 'products', 'brands', 'cats', 'colors', 'sizes', 'minPrice', 'maxPrice')); 
    }  

    // Filter | Return Products by Brand and/or color and/or size and/or category
    public function returnProductsSearch($cat, $brand, $color, $size, $min_price, $max_price, $input_search) {
        $products = getSearcheRes(strtoupper($input_search));
        
        $allproducts = [];
        if($cat!=0){
            for($i=0;$i<count($products);$i++)
                if($products[$i]['cat_id'] == $cat) array_push($allproducts, $products[$i]);
           $products = $allproducts;
           $allproducts = [];
        }  
         
        if($brand!=0){
            for($i=0;$i<count($products);$i++)
                if($products[$i]['brand_id'] == $brand) array_push($allproducts, $products[$i]);
           $products = $allproducts;
           $allproducts = [];
        } 

        if(count($color)>0){
            for($i=0;$i<count($products);$i++)
                if(in_array($products[$i]['color'], $color)) array_push($allproducts, $products[$i]);
           $products = $allproducts;
           $allproducts = [];
        }

        if(count($size)>0){
            for($i=0;$i<count($products);$i++)
                if(in_array($products[$i]['size'], $size)) array_push($allproducts, $products[$i]);
           $products = $allproducts;
           $allproducts = [];
        } 

        for($i=0;$i<count($products);$i++)
            if($products[$i]['price'] >= $min_price && $products[$i]['price'] <= $max_price) array_push($allproducts, $products[$i]);
        $products = $allproducts;
        $allproducts = [];

        return $products;
    }   

    // Update Every thing in Search page | json response
    public function updateEveryThingSearch(Request $request) {
        $cat = $request->cat;
        $brand = $request->brand;
        $limit = $request->limit;
        $sort = $request->sort;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $input_search = $request->input_search;
        $color = colores($request);
        $size = sizes($request);
        $allProducts = $this->returnProductsSearch($cat, $brand, $color, $size, $min_price, $max_price, $input_search);
        $productss = sortpros($sort, $allProducts, $limit);
        session()->put('product_data', $productss);
        return response()->json([
            'success' => [$productss]
        ]);
    }
    
}
