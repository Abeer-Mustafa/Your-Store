<?php

use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Product;
use App\Models\Category;
use App\Models\Orders_products;
use App\Models\Recommendation;


// ===== To get information of the current laguages
// =================================================
function currentLang(){
    $lang = Session::has('locale') ? session('locale') : app()->getLocale();
    return $lang == 'ar' ? 'rtl' : 'ltr';
}

// ===== Paginat Results =====
// ===========================
function paginate($items, $perPage = PAGINATION_COUNT, $page = null, $options = [])
{
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make($items);
    return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
}


function getProductss($cat_id) { 
    $allproducts = [];
    $childs = Category::where('parent_id', $cat_id)->get();
    $products = Product::where('cat_id', $cat_id)->get();
    if($products)array_push($allproducts, $products);
    if($childs->count()>0)foreach ($childs as $child) {  
    	$data = getProductss($child->id); 
    	if($data)array_push($allproducts, $data);
    }
    return $allproducts;
}		

function top_sales() { 
    $top_sales = array();
    $products_sales = Orders_products::all();
    foreach ($products_sales as $pro) {
        if(array_key_exists($pro->product_id,$top_sales)) $top_sales[$pro->product_id] += $pro->qty;
        else $top_sales[$pro->product_id] = $pro->qty;
    }
    arsort($top_sales);
    return $top_sales;
}  

function top_sales20() {
	$top_sales = top_sales();
    return array_slice($top_sales, 0, 19, true);
}   

function top_sales10() { 
    $top_sales = top_sales();
    return array_slice($top_sales, 0, 9, true);
} 

function top_sales4() { 
    $top_sales = top_sales();
    return array_slice($top_sales, 0, 3, true);
}

// return all array of colores from filter request
function colores($request){
    $color = [];
    if($request->Red)array_push($color, "Red");
    if($request->White)array_push($color, "White");
    if($request->Blue)array_push($color, "Blue");
    if($request->Green)array_push($color, "Green");
    if($request->Pink)array_push($color, "Pink");
    if($request->Gray)array_push($color, "Gray");
    if($request->Purple)array_push($color, "Purple");
    if($request->Orange)array_push($color, "Orange");
    if($request->Yellow)array_push($color, "Yellow");
    if($request->Brown)array_push($color, "Brown");
    if($request->Black)array_push($color, "Black");
    return $color;
}

// return all array of sizes from filter request
function sizes($request){
    $size = [];
    if($request->S)array_push($size, "S");
    if($request->XS)array_push($size, "XS");
    if($request->XXS)array_push($size, "XXS");
    if($request->M)array_push($size, "M");
    if($request->L)array_push($size, "L");
    if($request->XL)array_push($size, "XL");
    if($request->XXL)array_push($size, "XXL");
    return $size;
}

// sort products 
function sortpros($sort, $allProducts, $limit) {
    if($sort == 'created_DESC') {$created = array_column($allProducts, 'created_at'); array_multisort($created, SORT_DESC, $allProducts);}
    if($sort == 'name_ASC')     {$name = array_column($allProducts, 'name'); array_multisort($name, SORT_ASC, $allProducts);}
    if($sort == 'name_DESC')    {$name = array_column($allProducts, 'name'); array_multisort($name, SORT_DESC, $allProducts);}
    if($sort == 'price_ASC')    {$price = array_column($allProducts, 'price'); array_multisort($price, SORT_ASC, $allProducts);}
    if($sort == 'price_DESC')   {$price = array_column($allProducts, 'price'); array_multisort($price, SORT_DESC, $allProducts);}
    if($sort == 'rating_ASC')   {$rating = array_column($allProducts, 'rating'); array_multisort($rating, SORT_ASC, $allProducts);}
    if($sort == 'rating_DESC')  {$rating = array_column($allProducts, 'rating'); array_multisort($rating, SORT_DESC, $allProducts);}
    $productss = array_slice($allProducts, 0, $limit);
    return $productss;
}

function recommndations($pro_info){
    $recommndations = array();
    $product_id = $pro_info->id;
    // get products recommendations table
    $proucts_rec = Recommendation::where('user_id', Auth::user()->id)->get();
    // get products from same category
    $footer_cat = Product::where([['cat_id', $pro_info->cat_id], ['id', '!=',$product_id] ])->get();
    // add products of category to recommendations, and tabel (if not exist)
    foreach ($footer_cat as $pro) {
        if (!$proucts_rec->contains('product_id', $pro->id))
            Recommendation::create(['user_id'=>Auth::user()->id, 'product_id'=>$pro->id]);
        array_push($recommndations, $pro);
    }
    // add products of tabel to recommendations (if not exist)
    foreach ($proucts_rec as $pro) {
        if(!$footer_cat->contains('id', $pro->product_id) && $pro->product_id != $product_id) {
            $pro_info = Product::where('id', $pro->product_id)->first();
            array_push($recommndations, $pro_info);
        }
    }
    if (!$proucts_rec->contains('product_id', $product_id))
        Recommendation::create(['user_id'=>Auth::user()->id, 'product_id'=>$product_id]);
    $recommndations = array_slice($recommndations, 0, 20);
    session()->put('footer_recommndations', $recommndations);
}


