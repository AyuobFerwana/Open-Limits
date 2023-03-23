<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
// use Dotenv\Validator;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $users = User::paginate(10);
        return response()->view('ase.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('ase.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'UsersName' => 'required|string|min:3',
            'email' => 'required|string|unique',
            'phone' => 'required|string|min:10',
            'password' => 'required|confirmed|min:8|max:50',
            'password_confirmation' => 'required|string|min:8|max:50',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:5000',
        ]);

        if (!$validator->fails()) {
            $users = new User();
            $users->UserName = $request->input('UserName');
            $users->email = $request->input('email');
            $users->phone = $request->input('phone');
            $users->password = Hash::make($request->input('password'));
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_' . rand(1, 1000000) . '.' . $file->getClientOriginalExtension();
                $image = $file->storePubliclyAs('users', $imageName, ['disk' => 'public']);
                $users->image = $image;
            }

            $isSaved = $users->save();
            return response()->json([
                'message' => $isSaved ? 'Create User Successfully' : 'Create User Failed'
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
    public function show(User $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $users): Response
    {
        return response()->view('ase.users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $users)
    {
        $validator = Validator($request->all(), [
            'UsersName' => 'required|string|min:3',
            'email' => 'required|string|unique',
            'phone' => 'required|string|min:10',
            'password' => 'required|confirmed|min:8|max:50',
            'password_confirmation' => 'required|string|min:8|max:50',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:5000',
        ]);

        if (!$validator->fails()) {
            $users->UsersName = $request->input('UsersName');
            $users->email = $request->input('email');
            $users->phone = $request->input('phone');
            $users->password = Hash::make($request->input('password'));
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete('' . $users->image);
                $file = $request->file('image');
                $imageName = time() . '_' . rand(1, 1000000) . '.' . $file->getClientOriginalExtension();
                $image = $file->storePubliclyAs('users', $imageName, ['disk' => 'public']);
                $users->image = $image;
            }

            $isSaved = $users->save();
            return response()->json([
                'message' => $isSaved ? 'Update User Successfully' : 'Update User Failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }



    //  Update User Account
    public function account(User $users)
    {

        return response()->view('ase.users.account-user', compact('users'));
    }

    public function accountUpdate(Request $request)
    {
        $validator = Validator($request->all(), [
            'UsersName' => 'required|string|min:3',
            'email' => 'required|string|unique:users,email,' . $request->user()->id,
            'phone' => 'required|string|min:10',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:5000',
        ]);

        if (!$validator->fails()) {
            $users = $request->user();
            $users->UsersName = $request->input('UsersName');
            $users->email = $request->input('email');
            $users->phone = $request->input('phone');
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete('' . $users->image);
                $file = $request->file('image');
                $imageName = time() . '_' . rand(1, 1000000) . '.' . $file->getClientOriginalExtension();
                $image = $file->storePubliclyAs('users', $imageName, ['disk' => 'public']);
                $users->image = $image;
            }

            $isSaved = $users->save();
            return response()->json([
                'message' => $isSaved ? 'Update User Account Successfully' : 'Update User Account Failed'
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
    public function destroy(User $users)
    {
        $isDelete = $users->delete();
        return response()->json(
            ['message' => $isDelete ? ' Delete Successfully ! ' : ' Delete Faild ! '],
            $isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }


    // Restore User Deteted
    public function restoreUsers(Request $request)
    {

        $users = User::onlyTrashed()->paginate(10);

        return response()->view('ase.users.userDeleted', compact('users'));
    }

    public function restore($id)
    {
        User::withTrashed()->findOrFail($id)->restore();
        return back();
    }

    public function RestoreAll()
    {
        User::onlyTrashed()->restore();
        return back();
    }

    public function Restoredestroy($id)
    {
        $users = User::withTrashed()->findOrFail($id);
        $users->forceDelete();
        return response()->json(
            [
                'message' => $users ? 'Delete Successfully ! ' : ' Delete Failed ! '
            ],
            $users ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }






    //  ReSet -  Password
    public function resetPass(Request $request)
    {
        return response()->view('ase.settings.reset-password');
    }

    public function updatePasswod(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|current_password',
            'new_password' => 'required|string|confirmed|min:8|max:50',
            
        ]);

        if (!$validator->fails()) {
            $user = $request->user();
            $user->password = Hash::make($request->input('new_password'));
            $isSaved = $user->save();
            return response()->json([
                'message' => $isSaved ? 'Password changed Successfully' : 'Password change Failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
