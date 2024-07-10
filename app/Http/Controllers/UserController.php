<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::withTrashed()->get();
        return view('dash.user.all', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $data = User::all();

        return view('dash.user.add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'role' => ['required','string','max:255',
                Rule::in(['user', 'admin']), // This is the correct way to use Rule::in
            ],
            'email' => 'required|string|email|max:255|unique:users,email', // Correct the unique rule
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validate['name'],
            'role' => $validate['role'],
            'email' => $validate['email'],
            'password' => bcrypt($validate['password']),
        ]);

        return redirect()->route('dashboard.users.index')->with('success', 'User created successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = User::all();

        return view('dash.user.edit',compact('user','data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'role' => 'required|string|max:255',Rule::in(['user', 'admin']),
        'email' =>'|required|string|email|max:255',Rule::unique('users', 'email')->ignore($user->id),
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $user->update([
        'name' => $validatedData['name'],
        'role' => $validatedData['role'],
        'email' => $validatedData['email'],
        'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,
    ]);

    return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully');

    }
    public function restore(User $user)
    {
        $user->restore();
        return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully');

    }
    public function erase(User $user)
    {
        $user->forceDelete();
        return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully');

    }
}
