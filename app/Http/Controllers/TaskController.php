<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        // Fetch tasks only for the authenticated user
        $tasks = Auth::user()->tasks()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ], [
            'task.required' => 'Please enter a task.',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'task' => $request->task,
        ]);

        return redirect('/tasks');
    }
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        $task->update([
            'task' => $request->task,
        ]);

        return redirect('/tasks')->with('success', 'Task updated successfully.');
    }


    public function delete(Task $task)
    {
        $task->delete();

        return redirect('/tasks')->with('success', 'Task deleted successfully.');
    }
}
