<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    /**
     * Display the tasks index view.
     */
    public function index(): View
    {
        return view('tasks.index', [
            'tasks' => Task::where('user_id', auth()->id())->paginate(10),
        ]);
    }

    /**
     * Store a new task.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string|in:pending,completed',
            'expires_at' => 'nullable|date|after:today|after:recurrence_end_date',            
            'recurrence_type' => 'nullable|string|in:daily,weekly,monthly,yearly',
            'recurrence_end_date' => 'nullable|date|after:today',
        ]);

        
        $request->user()->tasks()->create($request->all());

        return Redirect::route('tasks.index')->with('success', __('tasks.created'));
    }

    /**
     * Delete a task.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {

            return Redirect::route('tasks.index');
        }

        $task->delete();

        return Redirect::route('tasks.index')->with('success', __('tasks.deleted'));
    }

    /**
     * Edit a task.
     */
    public function edit(Task $task): View
    {
        if ($task->user_id !== auth()->id()) {
            return Redirect::route('tasks.index');
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update a task.
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            return Redirect::route('tasks.index');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string|in:pending,completed,canceled',
            'expires_at' => 'nullable|date|after:today|after:recurrence_end_date',
            'recurrence_type' => 'nullable|string|in:daily,weekly,monthly,yearly',
            'recurrence_end_date' => 'nullable|date|after:today',
        ]);

        $task->update($request->all());

        return Redirect::route('tasks.index')->with('success', __('tasks.updated'));
    }

    /**
     * Search for a task.
     */
    public function search(Request $request): View
    {
        $tasks = Task::where('title', 'like', "%{$request->search}%")
            ->orWhere('description', 'like', "%{$request->search}%")
            ->where('user_id', auth()->id())
            ->paginate(10);

        return view('tasks.index', [
            'tasks' => $tasks,
            'search' => $request->search,
        ]);
    }
}
