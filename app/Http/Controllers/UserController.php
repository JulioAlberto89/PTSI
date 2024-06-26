<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users', ['users' => $users]);
    }

    public function create() {
        return view('users');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user) {
        return view('users-edit', ['user' => $user]);
    }

    public function update(Request $request, User $user) {
        $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email'
    ]);

    try {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email']
        ]);

        return redirect()->route('users.index')->with('success', 'User actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        if (auth()->user()->id == $user->id) {
            return redirect()->route('users.index')->with('error', 'No puedes eliminarte a ti mismo');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }
}
