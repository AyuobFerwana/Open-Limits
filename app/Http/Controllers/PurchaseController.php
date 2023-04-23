<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index(HttpRequest $request )
    {
        $user = $request->user();
        $checkouts = $user->checkouts()->where('status','paid')->get();
        return response()->view('ase.purchase.index', compact('checkouts'));
    }
}
