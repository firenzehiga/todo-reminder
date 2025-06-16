<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // User Management
    public function users()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users', compact('users'));
    }

    // Show specific user details
    public function showUser(User $user)
    {
        $user->setRelation('todos', $user->todos()->latest()->limit(10)->get());
        // Simple stats - langsung query
        $stats = [
            'total_todos' => $user->todos()->count(),
            'pending_todos' => $user->todos()->where('status', 'pending')->count(),
            'completed_todos' => $user->todos()->where('status', 'completed')->count(),
            'overdue_todos' => $user->todos()
                ->where('due_date', '<', now()->toDateString())
                ->where('status', '!=', 'completed')
                ->count(),
        ];

        return view('admin.user-detail', compact('user', 'stats'));
    }

    // All Todos Management
    public function todos()
    {
        $todos = Todo::with('user')->latest()->get();
        return view('admin.todos', compact('todos'));
    }

    // Delete user
    public function deleteUser(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Tidak bisa hapus admin!');
        }

        $user->todos()->delete(); // Hapus semua todos user
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }
}