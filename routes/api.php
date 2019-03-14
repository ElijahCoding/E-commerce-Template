<?php

Route::get('categories', 'Categories\CategoryController@index');
Route::resource('products', 'Products\ProductController');

Route::post('register', 'Auth\RegisterController@register');
