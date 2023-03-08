@foreach ($carts as $cart)
    <li class="cart-item">
        <div class="item-img">
            <a href="{{ route('front.productItem', $cart->product_id) }}"><img
                    src="{{ Storage::url($cart->product->image) }}" alt="Commodo Blown Lamp"></a>
            <button class="close-btn" onclick="removeProduct({{ $cart->product_id }}, this)"><i
                    class="fas fa-times"></i></button>
        </div>
        <div class="item-content">
            <h3 class="item-title"><a
                    href="{{ route('front.productItem', $cart->product_id) }}">{{ $cart->product->productName }}</a>
            </h3>
            <div class="item-price"><span
                    class="currency-symbol">$</span>{{ !$cart->product->flag ? $cart->product->price : $cart->product->discount }}
            </div>
            <div class="pro-qty item-quantity">
                <input type="number" class="quantity-input" id="quantity" value="{{ $cart->quantity }}">
            </div>
        </div>
    </li>
@endforeach
