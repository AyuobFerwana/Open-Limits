<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        return response()->view('ase.store.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('ase.store.create');
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
            'name' => 'required|string|min:3|max:30',
            'address' => 'required|string|min:3|max:300',
            'email' => 'required|email:rfc',
            'phone' => 'required|string|min:10',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:6000',
        ]);

        if (!$validator->fails()) {
            $stores = new Store();
            $stores->name = $request->input('name');
            $stores->address = $request->input('address');
            $stores->email = $request->input('email');
            $stores->phone = $request->input('phone');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_' . rand(1, 1000000) . '.' . $file->getClientOriginalExtension();
                $image = $file->storePubliclyAs('stores', $imageName, ['disk' => 'public']);
                $stores->image = $image;
            }
            $isSaved = $stores->save();
            return response()->json([
                'message' => $isSaved ? 'Create Store Successfully' : 'Create Store Failed'

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
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        // dd(123);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        return response()->view('ase.store.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:30',
            'address' => 'required|string|min:3|max:300',
            'email' => 'required|email:rfc',
            'phone' => 'required|string|min:10',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:6000',
        ]);

        if (!$validator->fails()) {
            $stores = new Store();
            $stores->name = $request->input('name');
            $stores->address = $request->input('address');
            $stores->email = $request->input('email');
            $stores->phone = $request->input('phone');
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete('' . $store->image);
                $file = $request->file('image');
                $imageName = time() . '_' . rand(1, 1000000) . '.' . $file->getClientOriginalExtension();
                $newImage = $file->storePubliclyAs('stores', $imageName, ['disk' => 'public']);
                $stores->image = $newImage;
            }
            $isSaved = $stores->save();
            return response()->json([
                'message' => $isSaved ? 'Edit Store Successfully' : 'Edit Store Failed'

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
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $isDeleted =  $store->delete();
        return response()->json(
            [
                'message' => $isDeleted ? 'Delete Successfully ! ' : ' Delete Failed ! '
            ],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }


    public function restoreStore(Request $request, Store $store)
    {
        $stores = Store::onlyTrashed()->paginate(10);

        return response()->view('ase.store.storeDeleted', compact('stores'));
    }

    public function resto($id)
    {
        Store::withTrashed()->findOrFail($id)->restore();
        return back();
    }

    public function restoreAll()
    {
        Store::onlyTrashed()->restore();
        return back();
    }

    public function RestoreStoreDestroy($id)
    {
        $store = Store::withTrashed()->findOrFail($id);
        $store->forceDelete();
        return response()->json(
            [
                'message' => $store ? 'Delete Successfully ! ' : ' Delete Failed ! '
            ],
            $store ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
