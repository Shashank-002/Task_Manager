<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Session::get('tasks', []);
        return view('tasks.index', compact('tasks'));
    }


    public function add(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ], [
            'task.required' => 'Please enter a task.',
        ]);
        $tasks = Session::get('tasks', []);
        $tasks[] = $request->task;
        Session::put('tasks', $tasks);

        return redirect('/tasks');
    }

    public function edit($taskIndex)
    {
        $tasks = Session::get('tasks', []);
        $task = $tasks[$taskIndex] ?? null;

        if (!$task) {
            return redirect('/tasks')->with('error', 'Task not found.');
        }

        return view('tasks.edit', compact('task', 'taskIndex'));
    }

    public function update(Request $request, $taskIndex)
    {
        $tasks = Session::get('tasks', []);
        $tasks[$taskIndex] = $request->task;
        Session::put('tasks', $tasks);

        return redirect('/tasks')->with('success', 'Task updated successfully.');
    }


    public function delete($taskIndex)
    {
        $tasks = Session::get('tasks', []);
        unset($tasks[$taskIndex]);
        Session::put('tasks', array_values($tasks));

        return redirect('/tasks');
    }
}
