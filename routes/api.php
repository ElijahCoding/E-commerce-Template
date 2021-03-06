<?php

Route::get('categories', 'Categories\CategoryController@index');
Route::resource('products', 'Products\ProductController');

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'Auth\RegisterController@action');
    Route::post('login', 'Auth\LoginController@action');
    Route::get('me', 'Auth\MeController@action');
});


Route::resource('cart', 'Cart\CartController', [
    'parameters' => [
        'cart' => 'productVariation'
    ]
]);
