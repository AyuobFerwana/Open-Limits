<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Payment\PayPalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SubscribeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




// logout
Route::middleware('auth')->group(function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Subscribe
Route::get('/subscribe/{newsLatter}', [SubscribeController::class, 'subscribe'])->name('subscribe');

// User Inter FAce
Route::redirect('/', '/openLimits');
Route::get('/openLimits', [FrontController::class, 'index'])->name('front.index');
Route::get('/openLimits/sidebar', [FrontController::class, 'sidebar'])->name('front.sidebar');
Route::get('/openLimits/search', [FrontController::class, 'productSearch']);
Route::get('/openLimits/quickView/{product}', [FrontController::class, 'quickView'])->name('front.quickView');
Route::get('/openLimits/product-item/{products}', [FrontController::class, 'productItem'])->name('front.productItem');


// Cart
Route::controller(CartController::class)->group(function(){
    Route::get('/openLimits/cart', 'show')->name('cart');
    Route::post('/openLimits/cart/add/{product}', 'add')->name('cart.add');
    Route::delete('/openLimits/cart/{product}', 'remove');
    Route::put('/openLimits/cart/{product}', 'changeQuantity');
});

// CheckOut
Route::get('/openLimits/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/openLimits/checkout/pay', [CheckoutController::class, 'pay'])->name('checkout.pay');

// Payment
Route::post('/openLimits/payment', [PayPalController::class, 'payment'])->name('payment');
Route::get('/openLimits/cancel', [PayPalController::class, 'cancel'])->name('payment.cancel');
Route::get('/openLimits/payment/success', [PayPalController::class, 'success'])->name('payment.success');

// Authentication
Route::middleware(['auth', 'role:admin,user'])->prefix('dashboard')->group(function () {

    // Dashboard
    Route::view('/', 'ase.dashboard')->name('home');

    // User Account
    Route::get('/account', [UserController::class, 'account'])->name('users.account');
    Route::put('/account-update', [UserController::class, 'accountUpdate'])->name('users.accountUpdate');

    // ReSet Password
    Route::get('/Reset-Password', [UserController::class, 'resetPass'])->name('user.resetPass');
    Route::put('/update-Password', [UserController::class, 'updatePasswod'])->name('user.updatePasswod');

    // Purchase
    Route::get('purchase', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::delete('purchase', [CheckoutController::class, 'destroy'])->name('purchase.destroy');
});

// Admin Role
Route::middleware(['auth', 'role:admin'])->prefix('dashboard')->group(function () {

    // User
    Route::get('users/restore', [UserController::class, 'restoreUsers'])->name('users.restoreUsers');
    Route::resource('/users', UserController::class);
    Route::get('users/restore/one/{id}', [UserController::class, 'restore'])->name('users.restore');
    Route::get('restoreUser', [UserController::class, 'RestoreAll'])->name('users.Restore.all');
    Route::delete('RestoreUserdestroy/{id}',  [UserController::class, 'Restoredestroy'])->name('users.Restoredestroy');

    // Product
    Route::get('products/restore', [ProductController::class, 'restoreProducts'])->name('products.restoreProducts');
    Route::resource('/products', ProductController::class);
    Route::get('products/restore/one/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::get('restoreProduct', [ProductController::class, 'RestoreAll'])->name('products.Restore.all');
    Route::delete('Restoredestroy/{id}',  [ProductController::class, 'Restoredestroy'])->name('products.Restoredestroy');

    // Category
    Route::get('category/restore', [CategoryController::class, 'restoreCategory'])->name('category.restoreCategory');
    Route::resource('/category', CategoryController::class);
    Route::get('category/restore/one/{id}', [CategoryController::class, 'restore'])->name('category.restore');
    Route::get('restoreCategory', [CategoryController::class, 'RestoreAll'])->name('category.Restore.all');
    Route::delete('RestoreCategoryDestroy/{id}',  [CategoryController::class, 'Restoredestroy'])->name('category.Restoredestroy');

    // Company Revenue
    Route::get('/revenue',[RevenueController::class,'revenue'])->name('revenue');
});

// login & Register

Route::middleware(['guest', 'throttle:authentication'])->group(function () {
    Route::view('/openLimits/login', 'ase.auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::view('/openLimits/register', 'ase.auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
});






// // Store
// Route::get('store/restore', [StoreController::class, 'restoreStore'])->name('store.restoreStore');
// Route::resource('/store', StoreController::class);
// Route::get('store/resto/one/{id}', [StoreController::class, 'resto'])->name('store.resto');
// Route::get('restoreAll', [StoreController::class, 'restoreAll'])->name('store.restore.all');
// Route::delete('RestoreStoreDestroy/{id}',  [StoreController::class, 'RestoreStoreDestroy'])->name('store.RestoreStoreDestroy');
