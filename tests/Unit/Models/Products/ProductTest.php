<?php

namespace Tests\Unit\Models\Products;

use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    public function test_it_uses_the_slug_for_the_route_key_name()
    {
        $product = new Product();

        $this->assertEquals($product->getRouteKeyName(), 'slug');
    }
}
