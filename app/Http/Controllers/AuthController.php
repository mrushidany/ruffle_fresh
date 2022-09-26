<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'phone_number'=>'required|string|max:15',
            'name'=>'required|string|max:50',
            'email'=>'string|max:50'
        ]);

        User::create([
            'name'=>$request->name,
            'phone_number'=>$request->phone_number,
            'password'=>bcrypt($request->password)
        ]);

        return view('success');
    }
}
