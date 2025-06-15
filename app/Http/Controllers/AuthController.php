<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirect based on user's role
            return $this->redirectToDashboard(Auth::user()->role);
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak sesuai.',
        ])->onlyInput('email');
    }

    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration (otomatis jadi user)
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:55'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Otomatis set role sebagai user
        $user = User::create([
            'name' => $validated['name'],
            'telepon' => $validated['telepon'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user', // Otomatis user
        ]);

        Auth::login($user);

        // Langsung ke dashboard user
        return redirect()->route('dashboard')
            ->with('success', 'Selamat datang! Akun Anda berhasil dibuat. Mari mulai dengan membuat todo list pertama Anda!');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }

    // Helper method to redirect to appropriate dashboard
    private function redirectToDashboard(string $role)
    {
        return match($role) {
            'user' => redirect()->route('dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            default => redirect()->route('dashboard')
        };
    }
}