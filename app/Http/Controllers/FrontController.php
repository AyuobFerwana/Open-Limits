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

    public function sidebar(Request $request)
    {
        $categories = Category::all();
        $products = Product::when($request->category && $request->category != -1, function ($q) use ($request) {
            return $q->where('category_id', $request->category);
        })->with('category')->get();
        return response()->view('ase.userInterface.shop-sidebar', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function productSearch(Request $request){
            $products = Product::when($request->productName,function($q) use ($request){
                $q->where('productName' , 'Like', "%$request->productName%");
            })->limit(10)->get();
            return response()->view('ase.components.product-search',compact('products'));
    }
  
}
