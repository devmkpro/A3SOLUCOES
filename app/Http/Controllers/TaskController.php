<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\View\View;
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
            'completed' => 'required|boolean',

        ]);

        $request->user()->tasks()->create($request->all());

        notyf()->success(__('tasks.created'), title: __('tasks.created'));

        return Redirect::route('tasks.index');
    }

    /**
     * Delete a task.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            flash()->error(__('tasks.not_allowed'), title: __('tasks.not_allowed'));

            return Redirect::route('tasks.index');
        }

        $task->delete();

        notyf()->success(__('tasks.deleted'), title: __('tasks.deleted'));

        return Redirect::route('tasks.index');
    }

    /**
     * Edit a task.
     */
    public function edit(Task $task): View
    {
        if ($task->user_id !== auth()->id()) {
            flash()->error(__('tasks.not_allowed'), title: __('tasks.not_allowed'));

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
            flash()->error(__('tasks.not_allowed'), title: __('tasks.not_allowed'));

            return Redirect::route('tasks.index');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'completed' => 'required|boolean',
        ]);

        $task->update($request->all());

        notyf()->success(__('tasks.updated'), title: __('tasks.updated'));

        return Redirect::route('tasks.index');
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
