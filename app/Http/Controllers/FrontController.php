<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Support;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{


    // The first Show For User
    public function index(Request $request, Cart $carts, User $users)
    {

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

        return response()->view('ase.userInterface.front', [
            'products' => $products,
            'categories' => $categories,
            'carts' => $carts,
            'users' => $users,
            'total' => $total,
            'support' => $support

        ]);
    }


    // product & Sort SideBAR
    public function sidebar(Request $request, Cart $carts)
    {
        if (Auth::check()) {
            $user = $request->user();
            $carts = $user->carts;
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
        $categories = Category::paginate(10);
        $products = Product::when($request->category && $request->category != -1, function ($q) use ($request) {
            return $q->where('category_id', $request->category);
        })->with('category')->when($request->sort && in_array($request->sort, ['latest', 'price-low', 'price-high']), function ($q) use ($request) {
            if ($request->sort == 'latest') {
                return $q->orderBy('id', 'desc');
            } elseif ($request->sort == 'price-low') {
                return $q->orderBy('price', 'asc');
            } else {

                return $q->orderByDesc('price');
            }
        })->get();
        return response()->view('ase.userInterface.shop-sidebar', [
            'products' => $products,
            'categories' => $categories,
            'carts' => $carts,
            'total' => $total,
            'support' => $support



        ]);
    }


    // Search
    public function productSearch(Request $request)
    {
        $products = Product::when($request->q, function ($q) use ($request) {
            $q->where('productName', 'Like', "%$request->q%");
        })->limit(10)->get();
        return response()->view('ase.components.product-search', compact('products'));
    }


    // quickView
    public function quickView(Product $product)
    {
        $categories = Category::all();

        return response()->view('ase.components.quick-view-product', [
            'products' => $product,
            'categories' => $categories,

        ]);
    }


    //  Product Show
    public function productItem(Product $products, Cart $carts, User $user,  Request $request)
    {

        if (Auth::check()) {
            $user = $request->user();
            $carts = $user->carts;
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
        return response()->view('ase.userInterface.product-item', [
            'products' => $products,
            'categories' => $categories,
            'carts' => $carts,
            'total' => $total,
            'support' => $support

        ]);
    }
}
