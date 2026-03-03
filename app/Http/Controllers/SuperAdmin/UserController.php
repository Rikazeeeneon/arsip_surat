<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role','!=','super_admin')->get();
        return view('Admin.Users.index', compact('users'));
    }

    public function create()
    {
        return view('Admin.Users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:4',
            'role' => 'required'
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('super_admin.users.index')
            ->with('success','User berhasil dibuat');
    }

    public function edit(User $user)
    {
        return view('Admin.Users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required',
            'role' => 'required'
        ]);

        $user->username = $request->username;
        $user->role = $request->role;

        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('super_admin.users.index')
            ->with('success','User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('super_admin.users.index')
            ->with('success','User berhasil dihapus');
    }
}