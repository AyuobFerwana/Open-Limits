<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register()
    {
        return view('ase.auth.register');
    }

    // Register
    public function store(Request $request, User $users)
    {
        $validator =  Validator($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|min:10|unique:users,phone',
            'password' => 'required|min:6|confirmed',

        ]);

        if (!$validator->fails()) {
            $users = new User();
            $users->UsersName = $request->input('name');
            $users->email = $request->input('email');
            $users->phone = $request->input('phone');
            $users->password = Hash::make($request->input('password'));
            $isSaved = $users->save();
            if ($isSaved) {
                Auth::login($users);
                $carts = Session::get('cart') ?? [];
                $databaseCarts = $users->carts;
                foreach ($carts as $cart) {
                    $isProductExists = false;
                    foreach ($databaseCarts as $dbCart) {
                        if ($dbCart->product_id == $cart->product_id) {
                            $isProductExists = true;
                            $dbCart->quantity += $cart->quantity;
                            $dbCart->save();
                            break;
                        }
                    }
                    if (!$isProductExists) {
                        $dbCart = new Cart();
                        $dbCart->user_id = $users->id;
                        $dbCart->quantity = $cart->quantity;
                        $dbCart->product_id = $cart->product_id;
                        $dbCart->save();
                    }
                }
                Session::remove('cart');
            }
            return response()->json([
                'message' => $isSaved ? 'Create User Successfully' : 'Create User Failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
            'remember' => ['required', 'in:true,false'],
        ]);

        if (!$validator->fails()) {
            $users = User::where('email', $request->input('login'))->orWhere('phone', $request->input('login'))->first();
            if (!$users) {
                return response()->json([
                    'message' => 'Wrong email or password.',
                ], Response::HTTP_BAD_REQUEST);
            }
            if (Hash::check($request->input('password'), $users->password)) {
                Auth::login($users, $request->input('remember'));
                $carts = Session::get('cart') ?? [];
                $databaseCarts = $users->carts;
                foreach ($carts as $cart) {
                    $isProductExists = false;
                    foreach ($databaseCarts as $dbCart) {
                        if ($dbCart->product_id == $cart->product_id) {
                            $isProductExists = true;
                            $dbCart->quantity += $cart->quantity;
                            $dbCart->save();
                            break;
                        }
                    }
                    if (!$isProductExists) {
                        $dbCart = new Cart();
                        $dbCart->user_id = $users->id;
                        $dbCart->quantity = $cart->quantity;
                        $dbCart->product_id = $cart->product_id;
                        $dbCart->save();
                    }
                }
                Session::remove('cart');
                return response()->json([
                    'message' => 'Logged in successfully!',
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'Wrong email or password.',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
