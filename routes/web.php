<?php

Auth::routes();

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get('/', 'HomeController@index');

    Route::group(['prefix' => 'orders', 'namespace' => 'Order'], function() {
        Route::get('/', 'IndexController@action')->name('admin.order.index');
        Route::get('/{id}', 'ViewController@action')->name('admin.order.view');
    });
});

Route::group(['prefix' => 'oauth', 'namespace' => 'Auth', 'middleware' => ['social']], function () {
    Route::get('redirect/{provider}', 'SocialController@redirect');
    Route::get('callback/{provider}', 'SocialController@callback');
});
