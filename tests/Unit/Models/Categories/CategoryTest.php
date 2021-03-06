<?php

namespace Tests\Unit\Models\Categories;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    public function test_it_has_many_children()
    {
        $category = factory(Category::class)->create();

        $category->children()->save(
            factory(Category::class)->create()
        );

        $this->assertInstanceOf(Category::class, $category->children()->first());
    }

    public function test_it_can_fetch_only_parents()
    {
        $category = factory(Category::class)->create();

        $category->children()->save(
            factory(Category::class)->create()
        );

        $this->assertEquals(1, Category::parents()->count());
    }

    public function test_it_is_orderable_by_a_number_order()
    {
        $category = factory(Category::class)->create([
            'order' => 1
        ]);

        $anotherCategory = factory(Category::class)->create([
            'order' => 2
        ]);

        $this->assertEquals($anotherCategory->name, Category::ordered('desc')->first()->name);
    }

    public function test_it_has_many_products()
    {
        $category = factory(Category::class)->create();

        $category->products()->save(
            factory(Product::class)->create()
        );

        $this->assertInstanceOf(Product::class, $category->products->first());
    }
}
