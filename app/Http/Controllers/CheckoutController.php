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
    public function checkout(Request $request, Cart $carts, User $users){

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

            if ($quantity >= 10) {
                $price *= 0.9; // 10% discount for quantities of 10 or more
            }
            $total += $quantity * $price;
        }
        $support = Support::first();
        
        $products = Product::all();

        $validator = Validator($request->all(),[
            'UsersName' => 'required|string',
            'region' => 'required',
            'address' => 'required|string|min:3|max:500',
            'town' => 'required|string|min:3|max:200',
            'phone' => 'required|string|min:3|max:15',
            'email' => 'required|string|unique',
        ]);
        if (!$validator->fails()) {
            $checkout = new Checkout();
            $cart->user_id =$request->input('UsersName');
            $cart->user_id = $request->user()->email;
            $cart->user_id = $request->user()->phone;
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
        return response()->view('ase.cart.checkout', [
            'products' => $products,
            'carts' => $carts,
            'checkout' => $checkout,
            'total' => $total,
            'support' => $support,
            'users'=>$users

        ]);
    }
}
