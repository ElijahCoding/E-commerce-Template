<?php

namespace App\Http\Controllers\Cart;

use App\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartStoreRequest;

class CartController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->middleware('auth:api');

        $this->cart = $cart;
    }

    public function store(Request $request)
    {
        $this->cart->add($request->products);
    }
}
