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
            if ($user->role === 'admin' && $user->status === 'active') {
                return redirect()->route('admin.dashboard');
            }else{
                return response()->json(['message' => 'Your Account is Deactivate'], 404);
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
            if ($user->role === 'user' && $user->status === 'active') {
                return response()->json(['user' => $user, 'message' => 'Login Successful'], 200);
            }else{
                return response()->json(['message' => 'Your Account is Deactivate'], 404);
            }
        
        }
        $user = User::where('email', $request->email)->first();

        if ($user) {
            return response()->json(['message' => 'Incorrect Password'], 404);
        } else {
            return response()->json(['message' => 'Invalid Email'], 404);
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
        return response()->json(['user' => $user, 'message' => 'User Registered Successfully'], 200);

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

    return response()->json(['user' => $user, 'message' => 'Profile Updated Successfully'], 200);
}



    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
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
        return response()->json(['message' => 'User logout Successfully'], 200);
    }



    public function userIndex()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(12);
        return view('backend.admin.user.index', ['users' => $users]);
    }
    public function userCreate()
    {
     return view('backend.admin.user.process');
    }
    public function userProcess(Request $request, $id = null)
       {
           if ($id) {
            $user = User::find($id);
            $validator = Validator::make($request->all(), [
                'name' => 'string',
            ]);
          
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $user->name = $request->input('name');
            $user->role = $request->input('role');
            $user->status = $request->input('status');

            if ($request->input('password')) {
                $user->password = bcrypt($request->input('password'));
            }
            
            $user->save();
            
            return redirect()->route('user.index')->with('success', 'User Updated Successfully.');
 
              
           } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required',
            ]);
    
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->role = $request->input('role');
            $user->status = $request->input('status');
            $user->save();

            return redirect()->route('user.index')->with('success', 'User Added Successfully.');
           }
 
       }
 
 
   public function userEdit($id)
   {
       $user = User::find($id);
       return view('backend.admin.user.process', ['user' => $user]);
   }
 
 
   public function userStatus(Request $request,$id)
   {
       $user = User::find($id);
       $user->status = $request->status;
         $user->save();
         return redirect()->back();
   }

   
    public function userDestroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully.');
    }
    
}
