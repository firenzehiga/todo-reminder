<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'telepon',
        'email',
        'password',
        'role',
        'timezone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Helper methods for role checking
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    // Relationship with todos
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    // Get pending todos - FIX: Method yang missing
    public function pendingTodos()
    {
        return $this->todos()->where('status', 'pending');
    }

    // Get completed todos - FIX: Method yang missing
    public function completedTodos()
    {
        return $this->todos()->where('status', 'completed');
    }

    // Get overdue todos - FIX: Method yang missing
    public function overdueTodos()
    {
        return $this->todos()->where('due_date', '<', now()->toDateString())
                            ->where('status', '!=', 'completed');
    }
}