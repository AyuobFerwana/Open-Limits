@extends('ase.dashboard')

@section('title', 'Index Users')

@section('style')

@endsection

@section('content')
<form id="payment-form">
    <input id="card-holder-name" type="text">

    <!-- Stripe Elements Placeholder -->
    <div id="card-element"></div>

    <button id="card-button" data-secret="{{ $intent->client_secret }}">
        Update Payment Method
    </button>
</form>

<form>
    <label for="card-holder-name">Name on card:</label>
    <input id="card-holder-name" type="text">

    <label for="card-element">Card details:</label>
    <div id="card-element"></div>

    <button id="submit-payment">Submit Payment</button>
</form>

<input id="card-holder-name" type="text">

<!-- Stripe Elements Placeholder -->
<div id="card-element"></div>

<button id="card-button">
    Process Payment
</button>

@endsection


@section('script')

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('stripe-public-key');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        var submitButton = document.getElementById('submit-button');
        submitButton.addEventListener('click', function(ev) {
            ev.preventDefault();

            stripe.confirmCardSetup(
                '{{ $setupIntent->client_secret }}', {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: '{{ Auth::user()->name }}'
                        }
                    }
                }
            ).then(function(result) {
                if (result.error) {
                    console.log(result.error.message);
                } else {
                    window.location.href = '/checkout';
                }
            });
        });
</script>

const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('submit-payment');
const clientSecret = cardButton.dataset.secret;
const cardElement = stripe.elements().create('card');

// Mount the card element to the page
cardElement.mount('#card-element');

// Handle the submit payment button click event
cardButton.addEventListener('click', async (e) => {
const { setupIntent, error } = await stripe.confirmCardSetup(
clientSecret, {
payment_method: {
card: cardElement,
billing_details: { name: cardHolderName.value }
}
}
);

if (error) {
// Display the error message to the user
alert(error.message);
} else {
// The payment has been successfully verified, so you can process it on the server
alert('Payment successful!');
}
});

<script>
    const stripe = Stripe('stripe-public-key');
 
    const elements = stripe.elements();
    const cardElement = elements.create('card');
 
    cardElement.mount('#card-element');



    const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
 
cardButton.addEventListener('click', async (e) => {
    const { paymentMethod, error } = await stripe.createPaymentMethod(
        'card', cardElement, {
            billing_details: { name: cardHolderName.value }
        }
    );
 
    if (error) {
        // Display "error.message" to the user...
    } else {
        // The card has been verified successfully...
    }
});
</script>

@endsection