<?php

namespace App\Http\Controllers;

use App\Models\SubTask;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubTaskController extends Controller
{
    /**
     * Display the tasks index view.
     */
    public function index(): View
    {
        return view('subtasks.index', [
            'subtasks' => auth()->user()->subtasks()->paginate(10),
            'tasks' => auth()->user()->tasks()->get(),
        ]);
    }

    /**
     * Store a new subtask.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string|in:pending,completed',
            'task_id' => 'required|exists:tasks,id',
            'expires_at' => 'nullable|date|after:today',
        ]);

        $task = auth()->user()->tasks()->find($request->task_id);
        if (!$task) {
            return Redirect::route('subtasks.index')->with('error', __('subtasks.task_not_found'));
        }

        $request->user()->subtasks()->create($request->all());

        return Redirect::route('subtasks.index')->with('success', __('subtasks.created'));
    }

    /**
     * Delete a subtask.
     */
    public function destroy(SubTask $subtask)
    {
        if ($subtask->task->user_id !== auth()->id()) {
            return Redirect::route('subtasks.index')->with('error', __('subtasks.not_allowed'));
        }

        $subtask->delete();

        return Redirect::route('subtasks.index')->with('success', __('subtasks.deleted'));
    }

    /**
     * Edit a subtask.
     */
    public function edit(SubTask $subtask): View
    {
        if ($subtask->task->user_id !== auth()->id()) {
            return Redirect::route('subtasks.index');
        }

        return view('subtasks.edit', [
            'subtask' => $subtask,
            'tasks' => auth()->user()->tasks()->get(),
        ]);
    }

    /**
     * Update a subtask.
     */
    public function update(Request $request, SubTask $subtask)
    {
        if ($subtask->task->user_id !== auth()->id()) {
            return Redirect::route('subtasks.index');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string|in:pending,completed',
            'expires_at' => 'nullable|date|after:today',
        ]);

        $subtask->update($request->all());

        return Redirect::route('subtasks.index')->with('success', __('subtasks.updated'));
    }

    /**
     * Search for a task.
     */
    public function search(Request $request): View
    {
        $request->validate([
            'search' => 'required|string|max:255',
        ]);
    
        $subtasks = SubTask::where('title', 'like', "%{$request->search}%")
            ->orWhere('description', 'like', "%{$request->search}%")
            ->whereHas('task', function ($query) {
                $query->where('user_id', auth()->id());
            });

        $subtasks = $subtasks->get()->filter(function ($subtask) {
            return $subtask->task->user_id === auth()->id();
        });

        
        return view('subtasks.index', [
            'subtasks' => $subtasks,
            'search' => $request->search,
            'tasks' => auth()->user()->tasks()->get(),
        ]);
    }
    
}
