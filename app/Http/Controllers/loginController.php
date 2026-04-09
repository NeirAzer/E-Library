<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email:dns|unique:users',
            'slug' => 'required|string|unique:users',
            'username' => 'required|string|min:8|unique:users|max:255',
            'password' => 'required|string|min:8|max:255',
            'role' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);  
        
        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }

    public function authenticate(Request $request)
    {
        // return dd($request->all());

        $credentials = $request->validate([
            'username' => 'required|string|min:3',
            'password' => 'required|string|min:8'
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $role = $user->role;

            switch ($role) {
                case 'admin':
                    return redirect()->intended('/dashboard');
                case 'user':
                    return redirect()->intended('/');
                
                default:
                    Auth::logout();
                    return redirect('/login')->with('error', 'Unauthorized role!');
            }
 
        }

        return back()->with('error', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
