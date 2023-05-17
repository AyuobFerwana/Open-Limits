<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;

class PurchaseController extends Controller
{
    public function index(HttpRequest $request )
    {
        $user = $request->user();
        $checkouts = $user->checkouts()->where('status','paid')->get();
        return response()->view('ase.purchase.index', compact('checkouts'));
    }
}
