<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
	Route::resource('images', 'Images\ImageController');
});



Route::resource('categories', 'Categories\CategoryController');
Route::get('menu', 'Categories\CategoryController@menu')->middleware('cacheResponse');
Route::get('kitchen', 'Categories\CategoryController@kitchen')->middleware('cacheResponse');
Route::get('bar', 'Categories\CategoryController@bar')->middleware('cacheResponse');


Route::resource('products', 'Products\ProductController');
Route::post('products/{product}/update', 'Products\ProductController@productCategories');
Route::patch('products/{product}/toggle/{field}', 'Products\ProductController@toggleField');


Route::resource('addresses', 'Addresses\AddressController');
Route::resource('shipping', 'ShippingMethods\ShippingController');
Route::resource('orders', 'Orders\OrderController');

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {
	Route::post('register', 'RegisterController@action');
	Route::post('login', 'LoginController@action');
	Route::get('user', 'LoginController@user')->middleware('auth:api');
});

Route::resource('cart', 'Cart\CartController', [
	'parameters' => [
		'cart' => 'productVariation'
	]
]);