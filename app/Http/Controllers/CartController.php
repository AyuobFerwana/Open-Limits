<?php

namespace App\Http\Controllers;

use App\Models\Cart as Cart;
use App\Models\Product;
// use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function show(Request $request)
    {
        if (Auth::check()) {
            $carts = $request->user()->carts;
        } else {
            $carts = Session::get('cart') ?? [];
        }
        return response()->view('ase.cart.cartShop', compact('carts'));
    }

    public function add(Product $product, Request $request)
    {
        if (Auth::check()) {
            $carts = $request->user()->carts;
            $cart = new Cart();
            $isProductInCart = false;
            foreach ($carts as $c) {
                if ($c->product_id == $product->id) {
                    $isProductInCart = true;
                    $cart = $c;
                    break;
                }
            }
            if ($isProductInCart) {
                $cart->quantity += $request->input('quantity');
            } else {
                $cart->user_id = $request->user()->id;
                $cart->product_id = $product->id;
                $cart->quantity = $request->input('quantity');
            }
            $isSaved = $cart->save();

            $carts = Cart::where('user_id', $request->user()->id)->get();

            return response()->json([
                'message' => $isSaved ? '!Added to Cart Successfully' : 'Failed to Add the Product, Please try Again.',
                'cartList' => view('ase.userInterface.components.cart-list', compact('carts'))->render(),
                'cartCount' => count($carts),
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            $carts = Session::get('cart') ?? [];
            $cart = new Cart();
            $isProductInCart = false;
            foreach ($carts as $c) {
                if ($c->product_id == $product->id) {
                    $isProductInCart = true;
                    $cart = $c;
                    break;
                }
            }
            if ($isProductInCart) {
                $cart->quantity += (int) $request->input('quantity');
            } else {
                $cart->product_id = $product->id;
                $cart->quantity = (int) $request->input('quantity');
                array_push($carts, $cart);
            }
            Session::put('cart', $carts);
            return response()->json([
                'message' => '!Added to Cart Successfully',
                'cartList' => view('ase.userInterface.components.cart-list', compact('carts'))->render(),
                'cartCount' => count($carts),
            ], Response::HTTP_CREATED);
        }
    }

    public function remove(Product $product, Request $request)
    {
        if (Auth::check()) {
            $deleted = Cart::where('user_id', $request->user()->id)->where('product_id', $product->id)->delete();
            return response()->json([
                'message' => $deleted ? 'Product Removed from cart successfully!' : 'Failed to remove product from cart, please try again later.',
                'cartCount' => $request->user()->carts()->count(),

            ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            $carts = Session::get('cart') ?? [];
            $cartIndex = -1;
            $isProductInCart = false;
            foreach ($carts as $key => $value) {
                if ($value->product_id == $product->id) {
                    $isProductInCart = true;
                    $cartIndex = $key;
                    break;
                }
            }
            if ($isProductInCart) {
                unset($carts[$cartIndex]);
                Session::put('cart', $carts);
            }
            return response()->json([
                'message' => 'Product Removed from cart successfully!',
                'cartCount' => count($carts),
            ], Response::HTTP_OK);
        }
    }

    public function changeQuantity(Product $product, Request $request)
    {
        $validator = Validator($request->all(), [
            'type' => 'required|string|in:dec,inc',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

        if (Auth::check()) {
            $cart = $request->user()->carts()->where('product_id', $product->id)->first();
            if ($request->input('type') == 'dec') {
                $cart->quantity--;
            } else {
                $cart->quantity++;
            }
            $isSaved = $cart->save();
            return response()->json([
                'message' => $isSaved ? 'saved' : 'faild',
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            $carts = Session::get('cart') ?? [];
            foreach ($carts as $c) {
                if ($c->product_id == $product->id) {
                    if ($request->input('type') == 'dec') {
                        $c->quantity--;
                    } else {
                        $c->quantity++;
                    }
                    break;
                }
            }
            Session::put('cart', $carts);
            return response()->json([
                'message' => 'saved',
            ], Response::HTTP_OK);
        }
    }
}
