<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Srmklive\PayPal\Services\ExpressCheckout;
use Symfony\Component\HttpFoundation\Response;

class PayPalController extends Controller
{

    public function payment(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Please login to place an order.',
            ], Response::HTTP_BAD_REQUEST);
        }


        $validator = Validator($request->all(), [
            'region' => 'required',
            'address' => 'required|string|min:3|max:500',
            'town' => 'required|string|min:3|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = [];
        $data['items'] = [];

        $user = $request->user();
        $carts = $user->carts;

        $total = 0;

        $productsIds = [];

        foreach ($carts as $cart) {
            $product = $cart->product;
            $quantity = $cart->quantity;

            //apply any quantity-based discounts or price breaks
            $price = $product->flag ? $product->discount : $product->price;
            $item = [];
            $item['name'] = $product->name;
            $item['price'] = $price;
            $item['desc'] = "Product With ID " . $product->id;
            $item['qty'] = $quantity;
            array_push($data['items'], $item);
            $productsIds[$product->id] = ['quantity' => $quantity];
            $total += $quantity * $price;
        }

        $checkout = new Checkout();
        $checkout->user_id = auth()->user()->id;
        $checkout->address = $request->input('address');
        $checkout->town = $request->input('town');
        $checkout->region = $request->input('region');
        $isSaved = $checkout->save();
        if ($isSaved) {
            $checkout->products()->attach($productsIds);
            $data['invoice_id'] = $checkout->id;
            $data['invoice_description'] = "Invoice for " . auth()->user()->id;
            $data['return_url'] = route('payment.success');
            $data['cancel_url'] = route('payment.cancel');
            $data['total'] = $total;

            $provider = new ExpressCheckout;
            $response = $provider->setExpressCheckout($data, true);
            return response()->json([
                'message' => 'Order has been placed successfully, you will be redirected shortly',
                'link' => $response['paypal_link'],
                'hhhh'=> $response, 
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'message' => 'Something went wrong, Please try again.',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function cancel()
    {
        return response()->json(['message'=>'Payment Cancelled'], Response::HTTP_PAYMENT_REQUIRED);
    }

    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $checkout = Checkout::findOrFail($response['PAYMENTREQUEST_0_INVNUM']);
            $checkout->status = 'paid';
            $checkout->save();
            return response()->json(['message'=>'Paid Success'] , Response::HTTP_OK);
        }
        return response()->json(['message'=>'Fail Payment'] , Response::HTTP_PAYMENT_REQUIRED);
    }
}
