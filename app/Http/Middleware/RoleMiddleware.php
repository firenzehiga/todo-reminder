<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if user has the required role
        if (Auth::user()->role !== $role) {
            // Redirect to appropriate dashboard based on user's actual role
            return $this->redirectToUserDashboard(Auth::user()->role);
        }

        return $next($request);
    }

    /**
     * Redirect user to their appropriate dashboard
     */
    private function redirectToUserDashboard(string $userRole): Response
    {
        return match($userRole) {
            'mahasiswa' => redirect()->route('dashboard.mahasiswa')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.'),
            'dosen' => redirect()->route('dashboard.dosen')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.'),
            default => redirect()->route('login')
                ->with('error', 'Role tidak valid.'),
        };
    }
}