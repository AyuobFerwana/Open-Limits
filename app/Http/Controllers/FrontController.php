<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request){
        $stores = Store::all();
        $products = Product::when($request->store && $request->store != -1, function ($q) use ($request) {
            return $q->where('store_id', $request->store);
        })->when($request->name, function ($q) use ($request) {
            return $q->where('name', 'LIKE', "%$request->name%");
        })->get();

        return response()->view('ase.userInterface.front', [
            'products' => $products,
            'stores' => $stores,
        ]);
        
    }
}
