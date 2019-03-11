<?php

Route::get('categories', 'Categories\CategoryController@index');
Route::resource('products', 'Products\ProductController');
