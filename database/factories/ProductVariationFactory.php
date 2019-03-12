<?php

use App\Models\Product;
use Faker\Generator as Faker;
use App\Models\ProductVariation;

$factory->define(ProductVariation::class, function (Faker $faker) {
    return [
        'product_id' => factory(Product::class)->create()->id,
        'name' => $faker->unique()->name
    ];
});
