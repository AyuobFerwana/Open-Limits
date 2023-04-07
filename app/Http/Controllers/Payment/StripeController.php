<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\SetupIntent;
use Stripe\Stripe;


class StripeController extends Controller
{
    public function showUpdatePaymentMethodForm()
    {

        Stripe::setApiKey(config('services.stripe.secret'));

        // Get the authenticated user
        $user = auth()->user();

        // Create a new payment setup intent for the user
        $intent = SetupIntent::create([
            'customer' => $user->stripe_customer_id
        ]);

        return view('ase.users.Billing-details', [
            'intent' => $intent
        ]);;
    }

    public function updatePaymentMethod()
    {
        // Set up the Stripe API key
        Stripe::setApiKey(config('services.stripe.secret'));

        // Get the authenticated user
        $user = auth()->user();

        // Get the payment method details from the request
        $paymentMethod = request('payment_method');

        // Attach the payment method to the customer
        $user->updateDefaultPaymentMethod($paymentMethod);

        // Return a success response
        return response()->json(['message' => 'Payment method updated.']);
    }
}
