<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'priority',
        'status',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Simple helper methods
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isOverdue()
    {
        return $this->due_date && $this->due_date->isPast() && !$this->isCompleted();
    }

    public function getPriorityColor()
    {
        return match($this->priority) {
            'high' => 'red',
            'medium' => 'yellow', 
            'low' => 'green',
            default => 'gray',
        };
    }
}