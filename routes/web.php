<?php

// Route::get('/test', 'FrontController@test');

define('PAGINATION_COUNT', 8);
define('IMAGE', asset('/storage').'/');
define('FILE', asset('/storage').'/');

Auth::routes();

Route::group(['namespace'=>'Front'], function(){

	Route::get('/', 'FrontController@index');
	Route::get('/currency', 'FrontController@currency');
	Route::get('/setlocale/{locale}', 'FrontController@lang');
	Route::get('/about', 'FrontController@about');
	Route::get('/contact', 'FrontController@contact');
	Route::post('/contact', 'FrontController@contactForm');
	Route::get('/getColors', 'FrontController@getColors');

	// categories
	Route::get('/categories', 'CategoryController@allCats');
	Route::get('/category/{id}', 'CategoryController@category')->name('category.show');
	Route::get('/updateEveryThing', 'CategoryController@updateEveryThing');
	// Brands
	Route::get('/brands', 'BrandController@allBrands');
	Route::get('/brand/{id}', 'BrandController@brand')->name('brand.show');
	Route::get('/updateEveryThingBrand', 'BrandController@updateEveryThingBrand');
	// Products
	Route::get('/products', 'ProductController@allProducts')->name('products.show');
	Route::get('/product/{id}', 'ProductController@product');
	Route::get('/updateEveryThingProducts', 'ProductController@updateEveryThingProducts');
	// Search
	Route::get('/search/{input}', 'FiltersController@search')->name('search.show');
	Route::get('/updateEveryThingSearch', 'FiltersController@updateEveryThingSearch');
	// Update all Products Div
	Route::get('/updateProducts', 'FiltersController@updateProducts'); 
});

/*
|--------------------------------
|---------- User Routes ---------
|--------------------------------
*/
Route::group(['middleware'=>'auth', 'namespace'=>'User'], function(){
	Route::post('/review/{id}', 'FrontAuthController@review');
	
	// Profile Page
	Route::get('/profile', 'ProfileController@profile');
	Route::get('/editProfile', 'ProfileController@editProfile');
	Route::post('/postProfile', 'ProfileController@postProfile');

	// Order Page
	Route::get('/orders', 'OrdersController@orders');
	Route::get('/order/{id}', 'OrdersController@orderPage');
	
	// Cart Page
	Route::get('/cart', 'CartPageController@cart');
	Route::post('/cartModify', 'CartPageController@cartModify');
	Route::post('/cartDelete', 'CartPageController@cartDelete');
	Route::get('/cartUpdate', 'CartPageController@cartUpdate');

	// wishlist
	Route::get('/wishlist', 'WishlistController@wishlist');
	Route::post('/wishlist', 'WishlistController@wishlistModify');
	Route::get('/wishUpdate', 'WishlistController@wishUpdate');

	// Cart Content
	Route::post('/cart/{id}', 'CartController@cart');
	Route::post('/cartHome/{id}', 'CartController@cartHome');
	Route::post('/removeItem/{id}', 'CartController@removeItem');
	Route::get('/cartContent', 'CartController@cartContent');
	Route::post('/wishlist/{id}', 'CartController@AddToWish');

	// Checkout
	Route::get('/checkout', 'FrontAuthController@checkout');
	Route::post('/checkout', 'FrontAuthController@stripePost');
});

