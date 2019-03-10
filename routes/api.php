<?php

use App\Models\Category;

Route::get('/', function () {
    $categories = Category::parents()->ordered('desc')->get();

    dd($categories);
});
