<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

Route::middleware('auth')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'add'])->name('tasks.add');
    Route::get('/tasks/edit/{task}', [TaskController::class, 'edit'])->name('tasks.edit'); // Edit route
    Route::put('/tasks/edit/{task}', [TaskController::class, 'update'])->name('tasks.update'); // Update route
    Route::delete('/tasks/delete/{task}', [TaskController::class, 'delete'])->name('tasks.delete');
});

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
