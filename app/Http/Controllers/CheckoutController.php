<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Support;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout(Request $request, Cart $carts, User $users){

        if (Auth::check()) {
            $users = $request->user();
            $carts = $users->carts;
        } else {
            $carts = Session::get('cart') ?? [];
        }

        $total = 0;

        foreach ($carts as $cart) {
            $product = $cart->product;
            $quantity = $cart->quantity;

            //apply any quantity-based discounts or price breaks
            $price = $product->flag ? $product->discount : $product->price;

            if ($quantity >= 10) {
                $price *= 0.9; // 10% discount for quantities of 10 or more
            }
            $total += $quantity * $price;
        }
        $support = Support::first();
        $categories = Category::all();
        $products = Product::when($request->category && $request->category != -1, function ($q) use ($request) {
            return $q->where('category_id', $request->category);
        })->when($request->categoryName, function ($q) use ($request) {
            return $q->where('categoryName', 'LIKE', "%$request->categoryName%");
        })->with('category')->get();

        return response()->view('ase.cart.checkout', [
            'products' => $products,
            'categories' => $categories,
            'carts' => $carts,
            'users' => $users,
            'total' => $total,
            'support' => $support

        ]);
    }
}
