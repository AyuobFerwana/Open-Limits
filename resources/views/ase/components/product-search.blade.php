@foreach ($products as $product)
<div class="axil-product-list">
    <div class="thumbnail">
        <a href="single-product.html">
            <img src="{{Storage::url($product->image)}}" width="100px" alt="Yantiti Leather Bags">
        </a>
    </div>
    <div class="product-content">

        <h6 class="product-title"><a href="{{route('front.sidebar')}}">{{$product->productName}}</a></h6>
        @if ($product->flag)

        <div class="product-price-variant">
            <span class="price current-price">${{$product->discount}}</span>
            <span class="price old-price">${{$product->price}}</span>
        </div>
        @else
        <div class="product-price-variant">
            <span class="price current-price">${{$product->price}}</span>
        </div>
        @endif
    </div>
</div>
@endforeach