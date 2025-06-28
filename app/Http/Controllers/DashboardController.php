<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // Dashboard for User (Personal Todo Management)
    public function user()
    {
        $user = Auth::user();
    
        // Stats sederhana untuk progress counter
        $today = now()->toDateString();
        $thisWeek = now()->startOfWeek();
        
        $stats = [
            'today_completed' => Todo::where('user_id', auth()->id())
                ->whereDate('updated_at', $today)
                ->where('status', 'completed')
                ->count(),
            'today_total' => Todo::where('user_id', auth()->id())
                ->whereDate('due_date', $today)
                ->count(),
            'week_completed' => Todo::where('user_id', auth()->id())
                ->where('updated_at', '>=', $thisWeek)
                ->where('status', 'completed')
                ->count(),
        ];
    
        // Data yang sudah ada sebelumnya
        $totalTodos = $user->todos()->count();
        $recentTodos = $user->todos()->latest()->limit(5)->get();
        $todos = $user->todos()->latest()->get();
        $pendingTodos = $user->pendingTodos()->count();
        $completedTodos = $user->completedTodos()->count();
        $overdueTodos = $user->overdueTodos()->count();
        $todayTodos = $user->todos()
            ->whereDate('due_date', today())
            ->where('status', '!=', 'completed')
            ->get();
    
        $upcomingTodos = $user->todos()
            ->whereBetween('due_date', [today(), today()->addDays(7)])
            ->where('status', '!=', 'completed')
            ->orderBy('due_date')
            ->get();
    
        $recentCompleted = $user->completedTodos()
            ->latest('updated_at')
            ->limit(5)
            ->get();
    
        $weeklyProgress = $this->getWeeklyProgress($user);
    
        return view('dashboard.user', compact(
            'stats', // Tambahkan ini
            'todos',
            'pendingTodos', 
            'recentTodos',
            'completedTodos',
            'overdueTodos',
            'todayTodos',
            'totalTodos',
            'upcomingTodos',
            'recentCompleted',
            'weeklyProgress'
        ));
    }

    // Dashboard for Admin (System Overview)
    public function admin()
    {
        // System statistics
        $totalUsers = User::where('role', 'user')->count();
        $totalTodos = Todo::count();
        $completedTodos = Todo::where('status', 'completed')->count();
        $overdueTodos = Todo::where('due_date', '<', now()->toDateString())
            ->where('status', '!=', 'completed')
            ->count();

        // Recent users (last 30 days)
        $recentUsers = User::where('role', 'user')->latest()->limit(5)->get(); // HASILNYA COLLECTION

        // Active users (users with todos in last 7 days)
        $activeUsers = User::where('role', 'user')
            ->whereHas('todos', function($query) {
                $query->where('created_at', '>=', now()->subDays(7));
            })
            ->count();

        // Most productive users
        $productiveUsers = User::where('role', 'user')
            ->withCount(['completedTodos' => function($query) {
                $query->where('updated_at', '>=', now()->subDays(30));
            }])
            ->orderBy('completed_todos_count', 'desc')
            ->limit(5)
            ->get();

        // Recent todos across all users
        $recentTodos = Todo::with('user')
            ->latest()
            ->limit(10)
            ->get();

        // Monthly statistics for charts
        $monthlyStats = $this->getMonthlyStats();

        return view('dashboard.admin', compact(
            'totalUsers',
            'totalTodos',
            'completedTodos',
            'overdueTodos',
            'recentUsers',
            'activeUsers',
            'productiveUsers',
            'recentTodos',
            'monthlyStats'
        ));
    }

    // Helper method to get weekly progress for user
    private function getWeeklyProgress($user)
    {
        $weeklyData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $completed = $user->todos()
                ->whereDate('updated_at', $date)
                ->where('status', 'completed')
                ->count();
            
            $weeklyData[] = [
                'date' => $date->format('M d'),
                'completed' => $completed
            ];
        }
        
        return $weeklyData;
    }

    // Helper method to get monthly statistics for admin
    private function getMonthlyStats()
    {
        $monthlyData = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            
            $users = User::where('role', 'user')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $todos = Todo::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            
            $monthlyData[] = [
                'month' => $date->format('M Y'),
                'users' => $users,
                'todos' => $todos
            ];
        }
        
        return $monthlyData;
    }
}