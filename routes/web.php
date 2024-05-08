<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
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
});

require __DIR__.'/auth.php';
