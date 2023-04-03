<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PayPalController extends Controller
{

    public function payment(Request $request)
    {
        // Retrieve the products from the database
        $products = Product::all();

        // Initialize the PayPal client
        $paypal = new PayPalClient();

        // Set the checkout parameters
        $data = [
            'items' => [],
            'invoice_id' => uniqid(),
            'invoice_description' => "Order description",
            'tax' => 5, // Set the tax amount
            'subtotal' => 0, // Initialize the subtotal to 0
            'shipping' => 10, // Set the shipping amount
            'return_url' => url('/paypal/success'),
            'cancel_url' => url('/paypal/cancel')
        ];

        // Loop through the products and add them to the checkout parameters
        foreach ($products as $product) {
            $item = [
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1
            ];

            // Add the item to the items array and update the subtotal
            $data['items'][] = $item;
            $data['subtotal'] += $item['price'];
        }

        // Create the payment
        $response = $paypal->createPayment($data);

        // Redirect the user to PayPal to complete the payment
        return redirect($response['paypal_link']);
    }
}
