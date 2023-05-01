<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function subscribe(Request $request){
        $request->validate([
            'email'=>'required|email|unique'
        ]);
        $subscription = new Subscribe();
        $subscription->email = $request->input('email');
        $subscription->save();
        return response()->view('ase.userInterface.components.subscribe');

        
    }
}
