<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Rules\ValidateBirthDate;
use App\Rules\ValidateCPF;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display the tasks index view.
     */
    public function index(): View
    {
        return view('users.index', [
            'users' => User::paginate(10),
        ]);
    }

    /**
     * Edit a task.
     */
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'cpf' => ['required', 'string', 'max:14', new ValidateCPF($user)],
            'birth_date' => ['required', 'date', 'before:today', new ValidateBirthDate()],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => preg_replace('/[^0-9]/', '', $request->cpf),
            'birth_date' => $request->birth_date,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', __('user.updated'));
    }

    /**
     * Search for a task.
     */
    public function search(Request $request)
    {
        $searchTerm = preg_replace('/[^0-9]/', '', $request->search);

        $users = User::where('name', 'like', "%{$request->search}%")
            ->orWhere('email', 'like', "%{$request->search}%")
            ->orWhereRaw("REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', '') LIKE ?", ["%{$searchTerm}%"])
            ->paginate(10);

        return view('users.index', [
            'users' => $users,
            'search' => $request->search,
        ]);
    }

    /**
     * Delete a task.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', __('user.deleted'));
    }
}
