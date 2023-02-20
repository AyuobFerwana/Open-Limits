<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Dotenv\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;




class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $categories = Category::all();
        return response()->view('ase.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('ase.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'categoryName' => 'required|string|max:50',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:5000',

        ]);

        if (!$validator->fails()) {
            $categories = new Category();
            $categories->categoryName = $request->input('categoryName');

            //  Image
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_' . rand(1, 1000000) . '.' . $file->getClientOriginalExtension();
                $image = $file->storePubliclyAs('categories', $imageName, ['disk' => 'public']);
                $categories->image = $image;
            }

            $isSaved = $categories->save();
            return response()->json([
                'message' => $isSaved ? 'Create Category Successfully' : 'Create Category Failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): Response
    {
        return response()->view('ase.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator($request->all(), [
            'categoryName' => 'required|string|max:50',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:5000',

        ]);

        if (!$validator->fails()) {
            $category->categoryName = $request->input('categoryName');

            //  Image
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete('' . $category->image);
                $file = $request->file('image');
                $imageName = time() . '_' . rand(1, 1000000) . '.' . $file->getClientOriginalExtension();
                $image = $file->storePubliclyAs('categories', $imageName, ['disk' => 'public']);
                $category->image = $image;
            }

            $isSaved = $category->save();
            return response()->json([
                'message' => $isSaved ? 'Create Category Successfully' : 'Create Category Failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $isDelete = $category->delete();
        return response()->json(
            ['message' => $isDelete ? ' Delete Successfully ! ' : ' Delete Faild ! '],
            $isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }


    public function restoreCategory(Request $request)
    {

        $categories = Category::onlyTrashed()->paginate(10);

        return response()->view('ase.category.categoryDeleted', compact('categories'));
    }

    public function restore($id)
    {
        Category::withTrashed()->findOrFail($id)->restore();
        return back();

      
    }

    public function RestoreAll()
    {
        Category::onlyTrashed()->restore();
        return back();
    }

    public function Restoredestroy($id)
    {
        $categories = Category::withTrashed()->findOrFail($id);
        $categories->forceDelete();
        return response()->json(
            [
                'message' => $categories ? 'Delete Successfully ! ' : ' Delete Failed ! '
            ],
            $categories ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
