<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    // The first Show For User
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::when($request->category && $request->category != -1, function ($q) use ($request) {
            return $q->where('category_id', $request->category);
        })->when($request->categoryName, function ($q) use ($request) {
            return $q->where('categoryName', 'LIKE', "%$request->categoryName%");
        })->with('category')->get();

        return response()->view('ase.userInterface.front', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }


    public function sidebar(Request $request)
    {
        // product & Sort
        $categories = Category::paginate(10);
        $products = Product::when($request->category && $request->category != -1, function ($q) use ($request) {
            return $q->where('category_id', $request->category);
        })->with('category')->when($request->sort && in_array($request->sort, ['latest', 'price-low', 'price-high']), function ($q) use ($request) {
            if ($request->sort == 'latest') {
                return $q->orderBy('id', 'desc');
            } elseif ($request->sort == 'price-low') {
                return $q->orderBy('price', 'asc');
            } else {

                return $q->orderByDesc('price');
            }
        })->get();
        return response()->view('ase.userInterface.shop-sidebar', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
    // Search
    public function productSearch(Request $request)
    {
        $products = Product::when($request->q, function ($q) use ($request) {
            $q->where('productName', 'Like', "%$request->q%");
        })->limit(10)->get();
        return response()->view('ase.components.product-search', compact('products'));
    }
    //  Product Show
    public function productItem(Product $products)
    {
        $categories = Category::all();
        return response()->view('ase.userInterface.product-item', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    
}
