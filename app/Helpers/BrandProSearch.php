<?php

/*
|--------------------------------------------------------------
|------- Helper functions for Brand \ Products | Search -------
|--------------------------------------------------------------
*/
use App\Models\Product;

// get products with one item from each code in Brand page
function getUniqueProBrand($products) { 
	$codes = array();
    foreach ($products as $key => $pro) {
      if( in_array($pro->code, $codes) ) $products->forget($key);
      else array_push($codes, $pro->code);
    }
    return $products;
}	

// Get all brands | colors | sizes | price for filter in Category page
function getAttrProBrand($products) { 
    $cats = [];
    $colors = [];
    $sizes = [];
    $price = [];
    foreach ($products as $product) {
        if(!in_array($product['cat_id'], $cats)) array_push($cats, $product['cat_id']);
        if(!in_array($product['color'], $colors)&& $product['color']) array_push($colors, $product['color']);
        if(!in_array($product['size'], $sizes) && $product['size']) array_push($sizes, $product['size']);
        if(!in_array($product['price'], $price) && $product['price']) array_push($price, $product['price']);
    }  
    sort($price);
    $minPrice = count($price)==0 ? 0 : $price[0];
    $maxPrice = count($price)==0 ? 0 : $price[count($price)-1];
    return [$cats, $colors, $sizes, $minPrice, $maxPrice];
}

// Get all cats | brands | colors | sizes | price for filter in Products page
function getAttrPros($products) { 
    $cats = [];
    $brands = [];
    $colors = [];
    $sizes = [];
    $price = [];
    foreach ($products as $product) {
        if(!in_array($product['cat_id'], $cats)) array_push($cats, $product['cat_id']);
        if(!in_array($product['brand_id'], $brands)) array_push($brands, $product['brand_id']);
        if(!in_array($product['color'], $colors)&& $product['color']) array_push($colors, $product['color']);
        if(!in_array($product['size'], $sizes) && $product['size']) array_push($sizes, $product['size']);
        if(!in_array($product['price'], $price) && $product['price']) array_push($price, $product['price']);
    }  
    sort($price);
    $minPrice = count($price)==0 ? 0 : $price[0];
    $maxPrice = count($price)==0 ? 0 : $price[count($price)-1];
    return [$cats,$brands, $colors, $sizes, $minPrice, $maxPrice];
}	

// get products for search result
function getSearcheRes($input){
    $products = array();
    $allproducts = Product::all();
    foreach ($allproducts as $pro) {
        $proName = strtoupper($pro->name);
        if (strpos($proName, $input) !== false) array_push($products, $pro);
    }
    return $products;
}