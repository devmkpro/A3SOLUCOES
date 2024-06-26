<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
        Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
        Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
        Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::get('/search', [TaskController::class, 'search'])->name('tasks.search');
    });

    Route::prefix('subtasks')->group(function () {
        Route::get('/', [SubTaskController::class, 'index'])->name('subtasks.index');
        Route::post('/store', [SubTaskController::class, 'store'])->name('subtasks.store');
        Route::delete('/{subtask}', [SubTaskController::class, 'destroy'])->name('subtasks.destroy');
        Route::put('/{subtask}', [SubTaskController::class, 'update'])->name('subtasks.update');
        Route::get('/{subtask}/edit', [SubTaskController::class, 'edit'])->name('subtasks.edit');
        Route::get('/search', [SubTaskController::class, 'search'])->name('subtasks.search');
    });

    Route::middleware('is_admin')->prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::get('/search', [UserController::class, 'search'])->name('users.search');
    });
});

require __DIR__.'/auth.php';
