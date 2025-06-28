<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;

class TodoTable extends Component
{
    public $todos;

    public function mount()
    {
        $this->todos = Todo::orderBy('created_at', 'desc')->get();
    }

    public function toggleComplete($todoId)
    {
        $todo = Todo::find($todoId);
        if ($todo) {
            // Toggle between pending and completed (skip in_progress for simple toggle)
            $todo->status = $todo->status === 'completed' ? 'pending' : 'completed';
            $todo->save();
            $this->todos = Todo::orderBy('created_at', 'desc')->get();
        }
    }

    public function setStatus($todoId, $status)
    {
        $todo = Todo::find($todoId);
        if ($todo && in_array($status, ['pending', 'in_progress', 'completed'])) {
            $todo->status = $status;
            $todo->save();
            $this->todos = Todo::orderBy('created_at', 'desc')->get();
        }
    }

    public function render()
    {
        return view('livewire.todo-table');
    }
}