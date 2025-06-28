{{-- filepath: resources/views/livewire/todo-table.blade.php --}}
{{-- Fix syntax errors in the todo-table component --}}
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    @if ($todos->count() > 0)
        <!-- Desktop Table View -->
        <div class="hidden lg:block">
            <div class="table-responsive">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Todo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($todos as $todo)
                            <tr wire:key="{{ $todo->id }}" class="hover:bg-gray-50 todo-row" 
                                data-todo-id="{{ $todo->id }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button
                                        wire:click="toggleComplete({{ $todo->id }})"
                                        wire:loading.class="opacity-50"
                                        class="focus:outline-none focus:ring-2 focus:ring-primary-500 rounded">                                       
                                        @if ($todo->isCompleted())
                                            <div class="h-5 w-5 bg-green-500 rounded-full flex items-center justify-center">
                                                <svg class="h-3 w-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="h-5 w-5 border-2 border-gray-300 rounded-full"></div>
                                        @endif
                                    </button>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="todo-title text-sm font-medium {{ $todo->isCompleted() ? 'line-through text-gray-400' : 'text-gray-900' }}">
                                        {{ $todo->title }}
                                    </div>
                                    @if ($todo->description)
                                        <div class="todo-description text-sm text-gray-500 mt-1">
                                            {{ Str::limit($todo->description, 50) }}
                                        </div>
                                    @endif
                                    <div class="todo-meta hidden">
                                        <span class="todo-status">{{ $todo->status }}</span>
                                        <span class="todo-priority">{{ $todo->priority }}</span>
                                        <span class="todo-date">{{ $todo->due_date ? $todo->due_date->format('Y-m-d') : '' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $todo->priority === 'high' ? 'bg-red-100 text-red-800' : 
                                           ($todo->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 
                                            'bg-green-100 text-green-800') }}">
                                        {{ ucfirst($todo->priority) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($todo->due_date)
                                        @if($todo->isOverdue())
                                            <span class="text-red-600 font-medium">
                                                {{ $todo->due_date->format('d M Y') }} (Overdue)
                                            </span>
                                        @else
                                            {{ $todo->due_date->format('d M Y') }}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium todo-actions space-x-2">
                                    <button onclick="kirimReminderGroup({{ $todo->id }})"
                                        class="inline-flex items-center justify-center px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded shadow">
                                        📱 Grup
                                    </button>
                                    <form method="POST" action="{{ route('todos.destroy', $todo) }}"
                                        class="inline" onsubmit="return confirm('Yakin hapus todo ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="lg:hidden divide-y divide-gray-200">
            @foreach ($todos as $todo)
                <div wire:key="{{ $todo->id }}" class="p-4 todo-row" data-todo-id="{{ $todo->id }}">
                    <div class="flex items-start space-x-3">
                        <!-- Toggle Complete -->
                        <button wire:click="toggleComplete({{ $todo->id }})" wire:loading.attr="disabled" 
                            class="flex-shrink-0 mt-1 focus:outline-none focus:ring-2 focus:ring-primary-500 rounded">
                            @if ($todo->isCompleted())
                                <div class="h-5 w-5 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="h-3 w-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="h-5 w-5 border-2 border-gray-300 rounded-full"></div>
                            @endif
                        </button>

                        <div class="flex-1 min-w-0">
                            <h3 class="todo-title text-sm font-medium {{ $todo->isCompleted() ? 'line-through text-gray-400' : 'text-gray-900' }}">
                                {{ $todo->title }}
                            </h3>
                            @if ($todo->description)
                                <p class="todo-description text-sm text-gray-500 mt-1">{{ $todo->description }}</p>
                            @endif
                            <div class="todo-meta flex flex-wrap items-center gap-2 mt-2">
                                <span class="todo-priority px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $todo->priority === 'high' ? 'bg-red-100 text-red-800' : 
                                       ($todo->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 
                                        'bg-green-100 text-green-800') }}">
                                    {{ ucfirst($todo->priority) }}
                                </span>
                                @if ($todo->due_date)
                                    <span class="todo-date text-xs {{ $todo->isOverdue() ? 'text-red-600 font-medium' : 'text-gray-500' }}">
                                        Due: {{ $todo->due_date->format('d M Y') }}
                                        @if($todo->isOverdue()) (Overdue) @endif
                                    </span>
                                @endif
                                <span class="text-xs text-gray-500">
                                    {{ $todo->created_at->diffForHumans() }}
                                </span>
                                <span class="todo-status hidden">{{ $todo->status }}</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="todo-actions flex flex-col space-y-1">
                            <button onclick="kirimReminderGroup({{ $todo->id }})"
                                class="inline-flex items-center justify-center px-2 py-1 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded shadow">
                                📱 Grup
                            </button>
                            <form method="POST" action="{{ route('todos.destroy', $todo) }}"
                                class="inline" onsubmit="return confirm('Yakin hapus todo ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-xs">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                </path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada todo</h3>
            <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat todo pertama Anda.</p>
            <div class="mt-6">
                <button onclick="openAddModal()"
                    class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    + Tambah Todo
                </button>
            </div>
        </div>
    @endif
</div>