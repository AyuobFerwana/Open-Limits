{{-- @foreach ($products as $product ) --}}

<div class="single-product-thumb">
    <div class="row">
        <div class="col-lg-7 mb--40">
            <div class="row">
                <div class="col-lg-10 order-lg-2">
                    <div
                        class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
                        <div class="thumbnail">
                            <img src="{{Storage::url('$products->image') }}" alt="Product Images">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 order-lg-1">
                    <div class="product-small-thumb small-thumb-wrapper">
                        <div class="small-thumb-img">
                            <img src="{{ Storage::url('$products->image') }}" alt="thumb image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 mb--40">
            <div class="single-product-content">
                <div class="inner">

                    <h5 class="title">{{ $products->category->categoryName }}</h5>
                    <h2 class="product-title">{{ $products->productName }}</h2>

                    @if ($products->flag)
                    <div class="product-price-variant">
                        <span class="price current-price">${{ $products->discount }}</span>
                        <del><span class="price old-price">${{ $products->price }}</span></del>
                    </div>
                    @else
                    <div class="product-price-variant">
                        <span class="price current-price">${{ $products->price }}</span>
                    </div>
                    @endif

                    <p>{{ $products->discreption }}</p>

                    <div class="product-variations-wrapper">

                        <!-- Start Product Variation  -->
                        <div class="product-variation">
                            <h6 class="title">Colors:</h6>
                            <div class="color-variant-wrapper">
                                <ul class="color-variant mt--0">
                                    <li class="color-extra-01 active"><span><span class="color"></span></span>
                                    </li>
                                    <li class="color-extra-02"><span><span class="color"></span></span>
                                    </li>
                                    <li class="color-extra-03"><span><span class="color"></span></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Product Variation  -->

                        <!-- Start Product Variation  -->
                        <div class="product-variation">
                            <h6 class="title">Size:</h6>
                            <ul class="range-variant">
                                <li>xs</li>
                                <li>s</li>
                                <li>m</li>
                                <li>l</li>
                                <li>xl</li>
                            </ul>
                        </div>
                        <!-- End Product Variation  -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @endforeach --}}