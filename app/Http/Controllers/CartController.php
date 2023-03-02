<?php

namespace App\Http\Controllers;

use App\Models\Cart as Cart;
use App\Models\Product;
// use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{

    public function store($id)
    {

        $cart = Cart::where('user_id', auth()->user()->id)->with('product')->get();
        return view('ase.cart.cartShop', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Check if the product is already in the cart
        $cartItem = Cart::where('user_id', auth()->user()->id)
            ->where('product_id', $id)->first();
            
        if (!$cartItem) {
            $cartItem = new Cart([
                'user_id' => auth()->user()->id,
                'product_id' => $id,
            ]);
            $isSaved = $cartItem->save();
            return response()->json(
                [
                    'message' => $isSaved ? ' Add to Cart ' : ' Faild to Add'
                ],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        }
    }



    public function remove($cartItemId)
    {
        $cartItem = Cart::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->route('cart');
    }

    public function update(Request $request, $cartItemId)
    {
        $cartItem = Cart::findOrFail($cartItemId);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index');
    }
}
