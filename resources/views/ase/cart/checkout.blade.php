<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Open-Limits| Checkout</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('fas/assets/images/favicon.png') }}">

    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('fas/assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fas/assets/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('fas/assets/css/vendor/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('fas/assets/css/vendor/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('fas/assets/css/vendor/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('fas/assets/css/vendor/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fas/assets/css/vendor/sal.css') }}">
    <link rel="stylesheet" href="{{ asset('fas/assets/css/vendor/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('fas/assets/css/vendor/base.css') }}">
    <link rel="stylesheet" href="{{ asset('fas/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/toastr/toastr.min.css') }}">

    <style>
        .toast-message {
            font-size: 14px !important;
        }
    </style>

</head>


<body class="sticky-header">
    <header class="header axil-header header-style-5">
        <div class="axil-header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="header-top-dropdown">
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    English
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">English</a></li>
                                    <li><a class="dropdown-item" href="#">Arabic</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    USD
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">USD</a></li>
                                    <li><a class="dropdown-item" href="#">EUR</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if (auth()->guest())
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="header-top-link">
                            <ul class="quick-link">
                                <li><a href="{{ route('login') }}">Sign In</a></li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Start Mainmenu Area  -->
        <div id="axil-sticky-placeholder"></div>
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-brand">
                        <a href="{{ route('front.index') }}" class="logo logo-dark">
                            <img src="{{ asset('fas/assets/images/logo/logo2.png') }}" alt="Site Logo">
                        </a>
                        <a href="index.html" class="logo logo-light">
                            <img src="{{ asset('fas/assets/images/logo/logo-light.png') }}" alt="Site Logo">
                        </a>
                    </div>
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="index.html" class="logo">
                                    <img src="{{ asset('fas/assets/images/logo/logo.png') }}" alt="Site Logo">
                                </a>
                            </div>
                            <ul class="mainmenu">
                                <li>
                                    <a href="{{ route('front.index') }}">Home</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">Shop</a>
                                    <ul class="axil-submenu">
                                        <li><a href="{{ route('front.sidebar') }}">Shop With Sidebar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <!-- End Mainmanu Nav -->
                    </div>
                    <div class="header-action">
                        <ul class="action-list">
                            <li class="axil-search d-xl-block d-none">
                                <input type="search" class="placeholder product-search-input" name="search2"
                                    id="search2" value="" maxlength="128" placeholder="?What are you looking for"
                                    autocomplete="off">
                                <button type="submit" class="icon wooc-btn-search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </button>
                            </li>
                            <li class="axil-search d-xl-none d-block">
                                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </a>
                            </li>
                            <li class="wishlist">
                                <a href="#">
                                    <i class="flaticon-heart"></i>
                                </a>
                            </li>
                            <li class="shopping-cart">
                                <a href="#" class="cart-dropdown-btn">
                                    <span class="cart-count" id="carts-count">{{ count($carts) }}</span>
                                    <i class="flaticon-shopping-cart"></i>
                                </a>
                            </li>
                            <li class="my-account">
                                <a href="javascript:void(0)">
                                    <i class="flaticon-person"></i>
                                </a>
                                <div class="my-account-dropdown">
                                    <span class="title">QUICKLINKS</span>
                                    <ul>
                                        <li>
                                            <a href="{{ route('home') }}">My Account</a>
                                        </li>
                                    </ul>
                                    @if (auth()->guest())
                                    <a href="{{ route('login') }}" class="axil-btn btn-bg-primary">Login</a>
                                    <div class="reg-footer text-center">No account yet? <a
                                            href="{{ route('register') }}" class="btn-link">REGISTER HERE.</a>
                                    </div>
                                    @endif
                                </div>
                            </li>
                            <li class="axil-mobile-toggle">
                                <button class="menu-btn mobile-nav-toggler">
                                    <i class="flaticon-menu-2"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mainmenu Area -->
        <div class="header-top-campaign">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-10">
                        <div class="header-campaign-activation axil-slick-arrow arrow-both-side header-campaign-arrow">
                            <div class="slick-slide">
                                <div class="campaign-content">
                                    <p>Shop NOW GET 10% OFF : <a href="#">GET OFFER</a></p>
                                </div>
                            </div>
                            <div class="slick-slide">
                                <div class="campaign-content">
                                    <p>Shop NOW GET 10% OFF : <a href="#">GET OFFER</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <main class="main-wrapper">

        <!-- Start Checkout Area  -->
        <div class="axil-checkout-area axil-section-gap">
            <div class="container">
                <form id="form" onsubmit="event.preventDefault(); payNow();">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="axil-checkout-notice">
                                <div class="axil-toggle-box">
                                    @if (auth()->guest())
                                    <div class="toggle-bar"><i class="fas fa-user"></i> Returning customer ? <a
                                            href="{{ route('login') }}" class="toggle-btn">Click here to
                                            login</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="axil-checkout-billing">
                                <h4 class="title mb--40">Billing details</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Full Name <span>*</span></label>
                                            @if (auth()->check() && auth()->user()->id !== $user->id)
                                            <input type="text" value="{{ auth()->user()->UsersName }}" {{ auth()->check() && auth()->user()->id
                                                === $user->id ? '' : 'disabled' }}>
                                            @else
                                            <input type="text" value="" {{ auth()->check() && auth()->user()->id
                                                === $user->id ? '' : 'disabled' }}>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Country/ Region <span>*</span></label>
                                    <select id="region">
                                        <option value="Pal">Palestine</option>
                                        <option value="Eng">England</option>
                                        <option value="Zeal">New Zealand</option>
                                        <option value="Switzer">Switzerland</option>
                                        <option value="Kindom">United Kindom (UK)</option>
                                        <option value="USA">United States (USA)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Street Address <span>*</span></label>
                                    <input type="text" id="address" class="mb--15"
                                        placeholder="House number and street name">
                                </div>
                                <div class="form-group">
                                    <label>Town/ City <span>*</span></label>
                                    <input type="text" id="town">
                                </div>
                                <div class="form-group">
                                    <label>Phone <span>*</span></label>
                                    @if (auth()->check() && auth()->user()->id !== $user->id)
                                    <input type="number" value="{{ auth()->user()->phone }}" {{ auth()->check() && auth()->user()->id
                                        === $user->id ? '' : 'disabled' }}>
                                    @else
                                    <input type="number" value="" {{ auth()->check() && auth()->user()->id
                                        === $user->id ? '' : 'disabled' }}>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Email Address <span>*</span></label>

                                        @if (auth()->check() && auth()->user()->id !== $user->id)
                                        <input type="email" value="{{ auth()->user()->email }}" {{ auth()->check() && auth()->user()->id === $user->id ? '' : 'disabled' }}>
                                        @else
                                        <input type="email" value="" {{ auth()->check() && auth()->user()->id === $user->id ? '' : 'disabled' }}>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="axil-order-summery order-checkout-summery">
                                <h5 class="title mb--20">Your Order</h5>
                                <div class="summery-table-wrap">
                                    <table class="table summery-table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($carts as $cart)
                                            <tr class="order-product">
                                                <td>{{ $cart->product->productName }}<span class="quantity">
                                                        x{{ $cart->quantity }}</span></td>
                                                <td>${{ $cart->quantity * (!$cart->product->flag ? $cart->product->price
                                                    : $cart->product->discount) }}
                                                </td>
                                            </tr>
                                            @endforeach

                                            <tr class="order-total">
                                                <td>Total</td>
                                                <td class="order-total-amount">${{ $total }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="order-payment-method">
                                    <div class="single-payment">
                                        <div class="input-group">
                                            <input type="radio" id="radio4" name="payment">
                                            <label for="radio4">Direct bank transfer</label>
                                        </div>
                                        <p>Make your payment directly into our bank account. Please us your Order ID as
                                            the payment reference. Your order will not be shipped until the funds have
                                            cleared in our account.</p>
                                    </div>

                                    <div class="single-payment">
                                        <div class="input-group justify-content-between align-items-center">
                                            <input type="radio" id="radio6" name="payment" checked>
                                            <label for="radio6">Paypal</label>
                                            <img src="{{ asset('fas/assets/images/others/payment.png') }}"
                                                alt="Paypal payment">
                                        </div>
                                        <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                            account.</p>
                                    </div>
                                </div>
                                <button type="submit" class="axil-btn btn-bg-primary checkout-btn">Process to
                                    Checkout</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Checkout Area  -->

    </main>


    <div class="service-area">
        <div class="container">
            <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="{{ asset('fas/assets/images/icons/service1.png') }}" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Fast &amp; Secure Delivery</h6>
                            <p>Tell about your service.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="{{ asset('fas/assets/images/icons/service2.png') }}" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Money Back Guarantee</h6>
                            <p>Within 10 days.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="{{ asset('fas/assets/images/icons/service3.png') }}" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">24 Hour Return Policy</h6>
                            <p>No question ask.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="{{ asset('fas/assets/images/icons/service4.png') }}" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Pro Quality Support</h6>
                            <p>24/7 Live support.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Footer Area  -->
    <footer class="axil-footer-area footer-style-2">
        <!-- Start Footer Top Area  -->
        <div class="footer-top separator-top">
            <div class="container">
                <div class="row">
                    <!-- Start Single Widget  -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="axil-footer-widget">
                            <h5 class="widget-title">Support</h5>
                            <!-- <div class="logo mb--30">
                            <a href="index.html">
                                <img class="light-logo" src="{{ asset('fas/assets/images/logo/logo.png') }}" alt="Logo Images">
                            </a>
                        </div> -->
                            <div class="inner">
                                <p>685 Market Street, <br>
                                    Las Vegas, LA 95820, <br>
                                    United States.
                                </p>
                                <ul class="support-list-item">
                                    <li><a href="mailto:example@domain.com"><i class="fal fa-envelope-open"></i>
                                            example@domain.com</a></li>
                                    <li><a href="tel:(+01)850-315-5862"><i class="fal fa-phone-alt"></i> (+01)
                                            850-315-5862</a></li>
                                    <!-- <li><i class="fal fa-map-marker-alt"></i> 685 Market Street,  <br> Las Vegas, LA 95820, <br> United States.</li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                    <!-- Start Single Widget  -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="axil-footer-widget">
                            <h5 class="widget-title">Account</h5>
                            <div class="inner">
                                <ul>
                                    <li><a href="my-account.html">My Account</a></li>
                                    <li><a href="sign-up.html">Login / Register</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="shop.html">Shop</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                    <!-- Start Single Widget  -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="axil-footer-widget">
                            <h5 class="widget-title">Quick Link</h5>
                            <div class="inner">
                                <ul>
                                    <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                    <li><a href="terms-of-service.html">Terms Of Us</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                    <!-- Start Single Widget  -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="axil-footer-widget">
                            <h5 class="widget-title">Download App</h5>
                            <div class="inner">
                                <span>Save $3 With App & New User only</span>
                                <div class="download-btn-group">
                                    <div class="qr-code">
                                        <img src="{{ asset('fas/assets/images/others/qr.png') }}" alt="Axilthemes">
                                    </div>
                                    <div class="app-link">
                                        <a href="#">
                                            <img src="{{ asset('fas/assets/images/others/app-store.png') }}"
                                                alt="App Store">
                                        </a>
                                        <a href="#">
                                            <img src="{{ asset('fas/assets/images/others/play-store.png') }}"
                                                alt="Play Store">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget  -->
                </div>
            </div>
        </div>
        <!-- End Footer Top Area  -->
        <!-- Start Copyright Area  -->
        <div class="copyright-area copyright-default separator-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-4">
                        <div class="social-share">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-discord"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="copyright-left d-flex flex-wrap justify-content-center">
                            <ul class="quick-link">
                                <li> ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with ❤️ by
                                    <a target="_blank" class="footer-link fw-bolder">Ayuob Ferwana</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div
                            class="copyright-right d-flex flex-wrap justify-content-xl-end justify-content-center align-items-center">
                            <span class="card-text">Accept For</span>
                            <ul class="payment-icons-bottom quick-link">
                                <li><img src="{{ asset('fas/assets/images/icons/cart/cart-1.png') }}" alt="paypal cart">
                                </li>
                                <li><img src="{{ asset('fas/assets/images/icons/cart/cart-2.png') }}" alt="paypal cart">
                                </li>
                                <li><img src="{{ asset('fas/assets/images/icons/cart/cart-5.png') }}" alt="paypal cart">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area  -->
    </footer>
    <!-- End Footer Area  -->

    <!-- Header Search Modal End -->
    <div class="header-search-modal" id="header-search-modal">
        <button class="card-close sidebar-close"><i class="fas fa-times"></i></button>
        <div class="header-search-wrap">
            <div class="card-header">
                <form action="#">
                    <div class="input-group">
                        <input type="search" class="form-control" onkeyup="productSearch(this)" name="prod-search"
                            id="prod-search" placeholder="Write Something....">
                        <button type="submit" class="axil-btn btn-bg-primary"><i class="far fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="search-result-header">
                    <span class="filter-results">Result (<span style="color: #3577F0; font-size:19px;">0</span>)
                        Found</span>
                    <a href="{{ route('front.sidebar') }}" class="view-all">View All</a>
                </div>
                <div class="psearch-results" id="searchContainer">

                </div>
            </div>
        </div>
    </div>
    <!-- Header Search Modal End -->



    <div class="cart-dropdown" id="cart-dropdown">
        <div class="cart-content-wrap">
            <div class="cart-header">
                <h2 class="header-title">Cart review</h2>
                <button class="cart-close sidebar-close"><i class="fas fa-times"></i></button>
            </div>

            <div class="cart-body">
                <ul class="cart-item-list" id="cart-list-container">
                    @foreach ($carts as $cart)
                    <li class="cart-item">
                        <div class="item-img">
                            <a href="{{ route('front.productItem', $cart->product_id) }}"><img
                                    src="{{ Storage::url($cart->product->image) }}" alt="Commodo Blown Lamp"></a>
                            <button class="close-btn" onclick="removeProduct({{ $cart->product_id }}, this)"><i
                                    class="fas fa-times"></i></button>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title"><a href="{{ route('front.productItem', $cart->product_id) }}">{{
                                    $cart->product->productName }}</a>
                            </h3>
                            <div class="item-price"><span class="currency-symbol">$</span>{{ !$cart->product->flag ?
                                $cart->product->price : $cart->product->discount }}
                            </div>

                            <div class="pro-qty item-quantity">
                                <span class="dec qtybtn"
                                    onclick="changeQuantity({{ $cart->product_id }}, 'dec', this)">-</span>
                                <input type="number" class="quantity-input" id="quantity_{{ $cart->product_id }}"
                                    value="{{ $cart->quantity }}">
                                <span class="inc qtybtn"
                                    onclick="changeQuantity({{ $cart->product_id }}, 'inc', this)">+</span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="cart-footer">
                <h3 class="cart-subtotal">
                    <span class="subtotal-title">Subtotal:</span>
                    <span class="subtotal-amount">${{ $total }}</span>

                </h3>
                <div class="group-btn">
                    <a href="{{ route('cart') }}" class="axil-btn btn-bg-primary viewcart-btn">View Cart</a>
                    <a href="{{ route('checkout') }}" class="axil-btn btn-bg-secondary checkout-btn">Checkout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="{{ asset('fas/assets/js/vendor/modernizr.min.js') }}"></script>
    <!-- jQuery JS -->
    <script src="{{ asset('fas/assets/js/vendor/jquery.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('fas/assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('fas/assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('fas/assets/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('fas/assets/js/vendor/js.cookie.js') }}"></script>
    <script src="{{ asset('fas/assets/js/vendor/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('fas/assets/js/vendor/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('fas/assets/js/vendor/sal.js') }}"></script>
    <script src="{{ asset('fas/assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('fas/assets/js/vendor/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('fas/assets/js/vendor/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('fas/assets/js/vendor/counterup.js') }}"></script>
    <script src="{{ asset('fas/assets/js/vendor/waypoints.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('fas/assets/js/rtl-main.js') }}"></script>

    <script src="{{ asset('js/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('js/Crud.js') }}"></script>
    <script src="{{ asset('js/sweet.js') }}"></script>


    <script>
        //Product Search
        function productSearch(e) {
            axios.get(`/product/search?q=${e.value}`)
                .then(function(response) {
                    console.log(response);
                    document.getElementById('searchContainer').innerHTML = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        // Remove Product from Slide Cart
        function removeProduct(id, ref) {
            let url = `/cart/${id}`;
            axios.delete(url).then((response) => {
                toastr.success(response.data.message);
                ref.closest('li').remove();
                document.getElementById('carts-count').innerHTML = response.data.cartCount;
            }).catch(() => {
                toastr.error(error.response.data.message);
            })
        }

        //Change Quantity
        function changeQuantity(id, type, ref) {
            setTimeout(() => {
                console.log(document.getElementById('quantity_' + id).value)
                if (document.getElementById('quantity_' + id).value < 1) {
                    removeProduct(id, ref)
                } else {
                    axios.put(`/cart/${id}`, {
                        type: type
                    }).then((response) => {
                        console.log(response.data);
                    }).catch((error) => {
                        console.log(error.response.data);
                    })
                }
            }, 1);
        }

     

        function payNow() {
            let data = {
                region: document.getElementById('region').value,
                town: document.getElementById('town').value,
                address: document.getElementById('address').value,
            }
            axios.post('{{ route('checkout.pay') }}', data)
                .then((response) => {
                    toastr.success(response.data.message);
                })
                .catch((error) => {
                    toastr.error(error.response.data.message);
                })
        }
    </script>
</body>

</html>