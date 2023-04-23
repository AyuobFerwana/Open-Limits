<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Checkout;
use App\Models\Product;
use App\Models\Support;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends Controller
{
    public function checkout(Request $request, User $user, Support $support)
    {
        if (Auth::check()) {
            $carts = $request->user()->carts;
        } else {
            $carts = Session::get('cart') ?? [];
        }

        $total = 0;

        foreach ($carts as $cart) {
            $product = $cart->product;
            $quantity = $cart->quantity;

            $price = $product->flag ? $product->discount : $product->price;

            $total += $quantity * $price;
        }
        $support = Support::first();

        return response()->view('ase.cart.checkout', compact('carts', 'total', 'user', 'support'));
    }


    public function pay(Request $request)
    {
        if (Auth::check()) {
            $checkout = $request->user();
            $carts = $checkout->carts;
        } else {
            $carts = Session::get('cart') ?? [];
        }

        $total = 0;

        foreach ($carts as $cart) {
            $product = $cart->product;
            $quantity = $cart->quantity;

            //apply any quantity-based discounts or price breaks
            $price = $product->flag ? $product->discount : $product->price;

            $total += $quantity * $price;
        }

        $validator = Validator($request->all(), [
            'region' => 'required',
            'address' => 'required|string|min:3|max:500',
            'town' => 'required|string|min:3|max:200',
        ]);

        if (!$validator->fails()) {

            $checkout = new Checkout();
            $cart->user_id = auth()->user()->id;
            $checkout->address = $request->input('address');
            $checkout->town = $request->input('town');
            $checkout->region = $request->input('region');


            $isSaved = $checkout->save();
            return response()->json([
                'message' => $isSaved ? 'Create Customer Billing  Successfully' : 'Create Customer Billing  Failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

   
}
