<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();

                // Return JSON response untuk AJAX
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil!',
                    'redirect' => $this->getRedirectUrl(Auth::user()->role)
                ]);
            }

            // Login gagal
            return response()->json([
                'success' => false,
                'message' => 'Email atau password tidak sesuai.'
            ], 422);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'telepon' => ['required', 'string', 'max:255'],
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            // Otomatis set role sebagai user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'telepon' => $validated['telepon'],
                'password' => Hash::make($validated['password']),
                'role' => 'user',
            ]);

            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil dibuat!',
                'redirect' => route('dashboard')
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    // Handle logout
    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'success' => true,
                'message' => 'Logout berhasil',
                'redirect' => route('login')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat logout.'
            ], 500);
        }
    }

    // Helper method to get redirect URL
    private function getRedirectUrl(string $role): string
    {
        return match($role) {
            'user' => route('dashboard'),
            'admin' => route('admin.dashboard'),
            default => route('dashboard'),
        };
    }
}