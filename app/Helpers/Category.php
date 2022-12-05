<?php

/*
|---------------------------------------------
|------- Helper functions for Category -------
|---------------------------------------------
*/


function getProducts($cat_id) { 
	$data = getProductss($cat_id);
	$flatten = flatten($data);
	foreach ($flatten as $key => $fl) {
	    if (!array_key_exists('cat_id', $fl))
	        unset($flatten[$key]);
	}

	$res = array_values($flatten);
	$products = [];
	for ($i=0; $i < count($res); $i+=2) { 
	    array_push($products, $res[$i]);
	}
	return $products;        
}

// convert array of arrays to array of items
function flatten($array){
    $flatArray = [];
    if (!is_array($array)) {
        $array = (array)$array;
    }
    foreach($array as $key => $value) {
        if (is_array($value) || is_object($value))
            $flatArray = array_merge($flatArray, flatten($value));
        else $flatArray[0][$key] = $value;
    }
    return $flatArray;
}

// Get all brands | colors | sizes | price for filter in Brand page
function getAttrProCat($products) { 
    $brands = [];
    $colors = [];
    $sizes = [];
    $price = [];
    foreach ($products as $product) {
        if(!in_array($product['brand_id'], $brands)) array_push($brands, $product['brand_id']);
        if(!in_array($product['color'], $colors)&& $product['color']) array_push($colors, $product['color']);
        if(!in_array($product['size'], $sizes) && $product['size']) array_push($sizes, $product['size']);
        if(!in_array($product['price'], $price) && $product['price']) array_push($price, $product['price']);
    }  
    sort($price);
    $minPrice = count($price)==0 ? 0 : $price[0];
    $maxPrice = count($price)==0 ? 0 : $price[count($price)-1];
    return [$brands, $colors, $sizes, $minPrice, $maxPrice];
}

// get products with one item from each code in Category page
function getUniqueProCat($products) { 
    $codes = array();
    foreach ($products as $key => $pro) {
      if( in_array($products[$key]['code'], $codes) ) unset($products[$key]);
      else array_push($codes, $products[$key]['code']);
    }
    return $products;
}	