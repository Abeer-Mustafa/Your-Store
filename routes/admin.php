<?php

/*
|--------------------------------
|---------- Admin Routes ---------
|--------------------------------
*/

Route::group(['prefix'=>'dashboard', 'namespace'=>'Admin', 'middleware'=>['auth', 'admin']], function(){
	
	Route::get('/', 'AdminController@index')->name('dashboard');
	Route::get('/getCats', 'AdminController@getCats')->name('getCats');	
	Route::get('/getBrands', 'AdminController@getBrands')->name('getBrands');	
	
	// Profile
	Route::get('/profile', 'AdminController@profile')->name('profile');	
	Route::post('/profilePost', 'AdminController@profilePost')->name('profilePost');	
	
	// To Do List
	Route::get('/getTasks', 'TaskController@getTasks')->name('getTasks');	
	Route::get('/getInfoTask', 'TaskController@getInfoTask')->name('getInfoTask');	
	Route::post('/addTask', 'TaskController@addTask')->name('addTask');	
	Route::post('/editTask', 'TaskController@editTask')->name('editTask');	
	Route::get('/delTask', 'TaskController@delTask')->name('delTask');	
	
	// Users
	Route::resource('/users', 'UserController');
	Route::post('/users/update', 'UserController@update')->name('users.update');	
	
	// Orders
	Route::get('/orders', 'OrdersController@orders')->name('orders'); // orders page
	Route::get('/pending_orders', 'OrdersController@pending_orders')->name('pending_orders'); // pending orders
	Route::get('/delivered_orders', 'OrdersController@delivered_orders')->name('delivered_orders'); // delivered orders
	Route::get('/all_orders', 'OrdersController@all_orders')->name('all_orders'); // all orders
	Route::get('/delivered', 'OrdersController@delivered')->name('delivered');
	Route::get('/delete_order', 'OrdersController@delete_order')->name('delete_order');
	Route::get('/view_order/{id}', 'OrdersController@view_order')->name('view_order');
	Route::get('/view_user/{id}', 'OrdersController@view_user')->name('view_user');
	
	// Reviews
	Route::get('/reviews', 'ReviewController@reviews')->name('reviews'); // change status
	Route::get('/pending_reviews', 'ReviewController@pending_reviews')->name('pending_reviews'); // pending reviews
	Route::get('/accepted_reviews', 'ReviewController@accepted_reviews')->name('accepted_reviews'); // accepted reviews
	Route::get('/all_reviews', 'ReviewController@all_reviews')->name('all_reviews'); // all reviews
	Route::get('/accepted', 'ReviewController@accepted')->name('accepted'); // change status
	Route::get('/delete_review', 'ReviewController@delete_review')->name('delete_review');
	Route::get('/view_pro/{id}', 'ReviewController@view_pro')->name('view_pro');
	Route::get('/view_rater/{id}', 'ReviewController@view_rater')->name('view_rater');
	
	// Notifications
	Route::get('/notifications', 'NotificationController@notifications')->name('notifications'); // notifications
	Route::get('/update_note', 'NotificationController@update_note')->name('update_note');
	Route::get('/delete_note', 'NotificationController@delete_note')->name('delete_note');
	Route::get('/all_nots', 'NotificationController@all_nots')->name('all_nots');
	
	//Categories
	Route::resource('/cats', 'CategoryController');

	//Products
	Route::resource('/products', 'ProductController');

	//Brands
	Route::resource('/brands', 'BrandController');
});