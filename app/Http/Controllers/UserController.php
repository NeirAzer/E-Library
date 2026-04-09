<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'User';
        $users = User::all();
        return view('dashboard.user.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'User | Create';
        return view('dashboard.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return dd($request->all());

        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'slug' => 'required|string|unique:users',
            'email' => 'required|email:dns|unique:users',
            'username' => 'required|string|min:8|unique:users|max:255',
            'password' => 'required|string|min:8|max:255',
            'role' => 'required'
        ]);

        User::create($validatedData);

        return redirect('/dashboard/user')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = 'User | Edit';

        return view('dashboard.user.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:8|max:255',
            'role' => 'required'
        ];

        if (request('slug') != $user->slug) {
            $rules['slug'] = 'required|string|unique:users';
        }

        if (request('email') != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        if (request('username') != $user->username) {
            $rules['username'] = 'required|string|min:8|unique:users|max:255';
        }

        $validatedData = $request->validate($rules);

        User::where('id', $user->id)->update($validatedData);

        return redirect('/dashboard/user')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect('/dashboard/user')->with('success', 'User deleted successfully');
    }
}
