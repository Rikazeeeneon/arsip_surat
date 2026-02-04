<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::where('role', 'user')->get()
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        return redirect('/admin/users')->with('success', 'User berhasil dibuat');
    }

    public function edit(User $user)
{
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $data = $request->validate([
        'username' => 'required|unique:users,username,' . $user->id,
        'role' => 'required',
        'password' => 'nullable|min:6',
    ]);

    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    } else {
        unset($data['password']);
    }

    $user->update($data);

    return redirect()->route('admin.users.index')
        ->with('success', 'User berhasil diperbarui');
}

public function destroy(User $user)
{
    $user->delete();

    return redirect()->route('admin.users.index')
        ->with('success', 'User berhasil dihapus');
}

}
