<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks for the current user.
     */
    public function index()
    {
        // For the purpose of this complete demo, if not logged in, 
        // we'll automatically log in the first user so the table isn't empty.
        if (!Auth::check()) {
            $user = User::first();
            if ($user) {
                Auth::login($user);
            }
        }

        $tasks = Task::where('user_id', Auth::id())
            ->orderBy('due_date', 'asc')
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Update the status of a task.
     */
    public function toggleStatus(Task $task)
    {
        // Authorization check
        if ($task->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $task->update([
            'status' => $task->status === 'completed' ? 'pending' : 'completed'
        ]);

        return back()->with('success', 'Task status updated successfully.');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $task->delete();

        return back()->with('success', 'Task deleted successfully.');
    }
}
