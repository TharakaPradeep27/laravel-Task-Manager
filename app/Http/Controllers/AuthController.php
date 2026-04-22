<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister(){
        return view('register');
    }
    public function register(Request $request){
        $request->validate([
            'name'=>'required|max:100',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|confirmed|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';

        $user->save();
        return redirect()->route('login.form')->with('success','User Registered SuccsessFully');

    }
    public function showlogin(){
        return view('login');
    }
    

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user(); // Get the logged-in user

            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'user') {
                return redirect()->route('user.dashboard');
            }

            // Default fallback
            Auth::logout();
            return back()->with('error', 'Role not recognized');
        }

        // Login failed
        return back()->with('error', 'Invalid login details');
    }
    public function admindashboard(){
        return view('admindashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form');
    }
}
