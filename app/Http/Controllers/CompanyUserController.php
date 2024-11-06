<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class CompanyUserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.company_users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.company_users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'occupation' => 'nullable|string|max:255',
            'experience' => 'nullable|numeric',
            // 'roles' => 'required|array',
        ]);

        $data = $request->only('name', 'email', 'occupation', 'experience');
        
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        $data['password'] = Hash::make($request->password);

        $user = User::create($data);
        $user->assignRole($request->roles);

        return redirect()->route('company_users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.company_users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // print($id);
        // die();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'occupation' => 'nullable|string|max:255',
            'experience' => 'nullable|string',
            'roles' => 'required',
        ]);

        $user = User::findOrFail($id);
        $data = $request->only('name', 'email', 'occupation', 'experience');
        
        if ($request->hasFile('avatar')) {
            // Delete old avatar if it exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        // $user->syncRoles($request->roles);
        $roles = Role::whereIn('id', $request->input('roles'))->pluck('name')->toArray();
        $user->syncRoles($roles);

        return redirect()->route('company_users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete avatar if it exists
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        return redirect()->route('company_users.index')->with('success', 'User deleted successfully.');
    }
}
