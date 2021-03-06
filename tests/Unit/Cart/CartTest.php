<?php

namespace Tests\Unit\Cart;

use App\Cart\Cart;
use Tests\TestCase;
use App\Cart\Money;
use App\Models\User;
use App\Models\ProductVariation;

class CartTest extends TestCase
{
    public function test_it_can_add_products_to_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $product = factory(ProductVariation::class)->create();

        $cart->add([
            ['id' => $product->id, 'quantity' => 1]
        ]);

        $this->assertCount(1, $user->fresh()->cart);
    }

    public function test_it_increments_quantity_when_adding_more_products()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $product = factory(ProductVariation::class)->create();

        $cart->add([
            ['id' => $product->id, 'quantity' => 1]
        ]);

        $cart = new Cart($user->fresh());

        $cart->add([
            ['id' => $product->id, 'quantity' => 1]
        ]);

        $this->assertEquals($user->fresh()->cart->first()->pivot->quantity, 2);
    }

    public function test_it_can_update_quantities_in_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(), [
                'quantity' => 1
            ]
        );

        $cart->update($product->id, 2);

        $this->assertEquals($user->fresh()->cart->first()->pivot->quantity, 2);
    }

    public function test_it_can_delete_a_product_from_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(), [
                'quantity' => 1
            ]
        );

        $cart->delete($product->id);

        $this->assertCount(0, $user->fresh()->cart);
    }

    public function test_it_can_empty_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create()
        );

        $cart->empty();

        $this->assertCount(0, $user->fresh()->cart);
    }

    public function test_it_can_check_if_the_cart_is_empty_of_quantities()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(), [
                'quantity' => 0
            ]
        );

        $this->assertTrue($cart->isEmpty());
    }

    public function test_it_returns_a_money_instance_for_the_subtotal()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $this->assertInstanceOf(Money::class, $cart->subtotal());
    }

    public function test_it_gets_the_correct_subtotal()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create([
                'price' => 1000
            ]), [
                'quantity' => 2
            ]
        );

        $this->assertEquals($cart->subtotal()->amount(), 2000);
    }
}
