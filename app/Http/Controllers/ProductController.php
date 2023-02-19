<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use LVR\Colour\Hex;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $products = Product::paginate(15);
        return response()->view('ase.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return response()->view('ase.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'category' => 'required|string',
            'size' => 'required|string',
            'productName' => 'required|string|min:3|max:50',
            'discreption' => 'required|string|min:3|max:200',
            'color' => ['required', new Hex],
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'flag' => 'required|string|in:price,discount',
            'quantity' => 'required|integer|min:0',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:5000',
            'colors' => 'required|integer',

        ]);
        if (!$validator->fails()) {
            $products = new Product();
            $products->category_id = $request->input('category');
            $products->productName = $request->input('productName');
            $products->discreption = $request->input('discreption');
            $products->price = $request->input('price');
            $products->discount = $request->input('discount');
            $products->quantity = $request->input('quantity');

            $products->flag = $request->input('flag') == 'discount';

            // quantity
            /*     $products = Product::find($productId);
            $products->decrement('quantity', $quantity);
            $products->quantity = $quantity;
            $products->decrementProductQuantity($productId, $quantity);*/



            // image
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_' . rand(1, 1000000) . '.' . $file->getClientOriginalExtension();
                $image = $file->storePubliclyAs('products', $imageName, ['disk' => 'public']);
                $products->image = $image;
            }
            // color
            $colors = [$request->input('color')];
            for ($i = 1; $i <= $request->input('colors'); $i++) {
                array_push($colors, $request->input('color_' . $i));
            }
            $products->colors = $colors;

            // Size
            $sizes = [];
            for ($i = 1; $i <= $request->input('size'); $i++) {
                array_push($sizes, $request->input('size_' . $i));
            }
            $products->size = $sizes;


            $isSaved = $products->save();
            return response()->json([
                'message' => $isSaved ? 'Create Product Successfully' : 'Create Product Failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Category $categories)
    {
        $categories = Category::all();
        return response()->view('ase.product.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, $productId, $quantity)
    {
        $validator = Validator($request->all(), [
            'category' => 'required',
            'color' => ['required', new Hex],
            'colors' => 'required|integer',
            'size' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'productName' => 'required|string|min:3|max:50',
            'discreption' => 'required|string|min:3|max:200',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'flag' => 'required|string|in:price,discount',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:5000',
        ]);
        if (!$validator->fails()) {
            $product = new Product();
            $product->category_id = $request->input('category');
            $product->productName = $request->input('productName');
            $product->discreption = $request->input('discreption');
            $product->price = $request->input('price');
            $product->discount = $request->input('discount');
            $product->flag = $request->input('flag') == 'discount';

            // image
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete('' . $product->image);
                $file = $request->file('image');
                $imageName = time() . '_' . rand(1, 1000000) . '.' . $file->getClientOriginalExtension();
                $Newimage = $file->storePubliclyAs('products', $imageName, ['disk' => 'public']);
                $product->image = $Newimage;
            }

            // color
            $colors = [$request->input('color')];
            for ($i = 1; $i <= $request->input('colors'); $i++) {
                array_push($colors, $request->input('color_' . $i));
            }
            $product->colors = $colors;

            // Size
            $sizes = [];
            for ($i = 1; $i <= $request->input('size'); $i++) {
                array_push($sizes, $request->input('size_' . $i));
            }
            $product->size = $sizes;

            // quantity
            // $product = Product::find($productId);
            // $product->decrement('quantity', $quantity);
            // $product->quantity = $quantity;
            // $product->decrementProductQuantity($productId, $quantity);

            $isSaved = $product->save();
            return response()->json([
                'message' => $isSaved ? 'Update Product Successfully' : 'Update Product Failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $isDelete = $product->delete();
        return response()->json(
            ['message' => $isDelete ? ' Delete Successfully ! ' : ' Delete Faild ! '],
            $isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }


    public function restoreProducts(Request $request)
    {

        $products = Product::onlyTrashed()->paginate(10);

        return response()->view('ase.product.storeDeleted', compact('products'));
    }

    public function restore($id)
    {
        Product::withTrashed()->findOrFail($id)->restore();
        return back();
    }

    public function RestoreAll()
    {
        Product::onlyTrashed()->restore();
        return back();
    }

    public function Restoredestroy($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->forceDelete();
        return response()->json(
            [
                'message' => $product ? 'Delete Successfully ! ' : ' Delete Failed ! '
            ],
            $product ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
