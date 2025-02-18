<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'add'])->name('tasks.add');
Route::delete('/tasks/{taskIndex}', [TaskController::class, 'delete'])->name('tasks.delete');
Route::get('/tasks/{taskIndex}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{taskIndex}', [TaskController::class, 'update'])->name('tasks.update');
