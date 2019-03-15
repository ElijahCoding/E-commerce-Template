<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartStoreRequest;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $products = $request->products;

        $products = collect($products)->keyBy('id')->map(function ($product) {
            return [
                'quantity' => $product['quantity']
            ];
        })->toArray();

        $request->user()->cart()->syncWithoutDetaching($products);
    }
}
