<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        try {
            // Validasi data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'account_type' => 'required|string|in:Employer,Employee',
                'occupation' => 'required|string|max:255',
                'experience' => 'required|numeric|min:0',
                'avatar' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            // Handle avatar upload
            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $avatarPath = $file->storeAs(
                    'avatars',
                    time() . '_' . $file->getClientOriginalName(),
                    'public'
                );
            }

            // Create user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'occupation' => $validated['occupation'],
                'experience' => $validated['experience'],
                'avatar' => $avatarPath,
            ]);

            // Assign role
            $role = $validated['account_type'] === 'Employer' ? 'employer' : 'employee';
            $user->assignRole($role);

            // Trigger registered event
            event(new Registered($user));

            // Generate token
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Registrasi berhasil',
                'token' => $token,
                'user' => $user->load('roles'),
            ], 201);

        } catch (\Exception $e) {
            // If there's an error, delete uploaded file if exists
            if (isset($avatarPath) && Storage::disk('public')->exists($avatarPath)) {
                Storage::disk('public')->delete($avatarPath);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mendaftar',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah',
            ], 401);
        }

        // Buat token API
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $user,
        ]);
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        // Hapus semua token user
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout berhasil',
        ]);
    }
}