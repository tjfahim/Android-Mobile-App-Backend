<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
        
        }
        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect()->back()->withInput()->withErrors(['password' => 'Incorrect password']);
        } else {
            return redirect()->back()->withInput()->withErrors(['email' => 'Invalid email']);
            }

    }
    public function loginApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'user') {
                return response()->json(['user' => $user, 'message' => 'Login successful'], 200);
            }
        
        }
        $user = User::where('email', $request->email)->first();

        if ($user) {
            return response()->json(['password' => 'Incorrect password']);
        } else {
            return response()->json(['email' => 'Invalid email']);
            }

    }


    public function registerApi(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = 'user';

        $user->save();

        Auth::login($user);
        $user = Auth::user();
        return response()->json(['user' => $user, 'message' => 'User registered successfully'], 201);

    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
    public function logoutApi(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'User logout successfully'], 201);
    }
    
}
