@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Your Tasks</h1>
        <p class="text-gray-600">Manage your daily productivity and deadlines.</p>
    </div>
    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-md flex items-center transition duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        New Task
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Priority</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Due Date</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($tasks as $task)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4">
                        <span class="font-medium text-gray-900">{{ $task->title }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-500 text-sm">
                        {{ Str::limit($task->description, 40) }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($task->status === 'completed')
                            <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                                Completed
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-700 rounded-full">
                                Pending
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @php
                            $priorityClasses = [
                                'high' => 'bg-red-100 text-red-700',
                                'medium' => 'bg-blue-100 text-blue-700',
                                'low' => 'bg-gray-100 text-gray-700',
                            ];
                            $class = $priorityClasses[$task->priority] ?? 'bg-gray-100 text-gray-700';
                        @endphp
                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $class }}">
                            {{ ucfirst($task->priority) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No Date' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $task->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">
                                {{ $task->status === 'completed' ? 'Undo' : 'Done' }}
                            </button>
                        </form>
                        
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500 italic">
                        No tasks found. Click "New Task" to get started!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
