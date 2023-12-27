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
            return response()->json(['errors' => $validator->errors()], 404);
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
            return response()->json(['message' => 'Incorrect password'], 404);
        } else {
            return response()->json(['message' => 'Invalid email'], 404);
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
            return response()->json(['errors' => $validator->errors()], 404);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = 'user';

        $user->save();

        Auth::login($user);
        $user = Auth::user();
        return response()->json(['user' => $user, 'message' => 'User registered successfully'], 200);

    }
    public function updateProfile(Request $request,$id)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'password' => 'nullable|min:6', 
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $user = User::find($id);
    $user->name = $request->input('name');

    if ($request->input('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    $user->save();

    return response()->json(['user' => $user, 'message' => 'Profile updated successfully'], 200);
}



    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
    public function profile(Request $request,$id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['error' => 'Unauthenticated'], 404);
        }
    }
    public function logoutApi(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'User logout successfully'], 200);
    }
    
}
