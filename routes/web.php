<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

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

             // User Inter FAce
    Route::get('/', [FrontController::class, 'index'])->name('front.index');
    Route::get('/products', [FrontController::class, 'sidebar'])->name('front.sidebar');
    Route::get('/product/search', [FrontController::class, 'productSearch']);
    Route::get('/product-item/{products}',[FrontController::class,'productItem'])->name('front.productItem');

            // Dashboard
    Route::redirect('/', '/dashboard');
    Route::prefix('dashboard')->group(function () {
    Route::view('/', 'ase.dashboard')->name('home');

    // // Store
    // Route::get('store/restore', [StoreController::class, 'restoreStore'])->name('store.restoreStore');
    // Route::resource('/store', StoreController::class);
    // Route::get('store/resto/one/{id}', [StoreController::class, 'resto'])->name('store.resto');
    // Route::get('restoreAll', [StoreController::class, 'restoreAll'])->name('store.restore.all');
    // Route::delete('RestoreStoreDestroy/{id}',  [StoreController::class, 'RestoreStoreDestroy'])->name('store.RestoreStoreDestroy');


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

            // Purchase
    Route::get('purchase', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::delete('purchase', [PurchaseController::class, 'destroy'])->name('purchase.destroy');
});
