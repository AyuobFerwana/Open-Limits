<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::when($request->category && $request->category != -1, function ($q) use ($request) {
            return $q->where('category_id', $request->category);
        })->when($request->categoryName, function ($q) use ($request) {
            return $q->where('categoryName', 'LIKE', "%$request->categoryName%");
        })->get();

        return response()->view('ase.userInterface.front', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
