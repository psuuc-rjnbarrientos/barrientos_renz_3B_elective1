<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\AuthController;

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');  // Show all projects
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create'); // Show form to create project
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store'); // Store new project
Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit'); // Show edit form
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update'); // Update project
Route::get('/projects/{id}/delete', [ProjectController::class, 'destroy'])->name('projects.destroy'); // Delete project

Route::get('/projects/{id}/tasks', [TaskController::class, 'index'])->name('tasks.index'); // Show all tasks for a project
Route::get('/projects/{id}/tasks/create', [TaskController::class, 'create'])->name('tasks.create'); // Show form to create task
Route::post('/projects/{id}/tasks', [TaskController::class, 'store'])->name('tasks.store'); // Store task
Route::get('/tasks/{taskId}/edit', [TaskController::class, 'edit'])->name('tasks.edit'); // Show edit form
Route::put('/tasks/{taskId}', [TaskController::class, 'update'])->name('tasks.update'); // Update task
Route::post('/tasks/{taskId}/delete', [TaskController::class, 'destroy'])->name('tasks.destroy'); // Delete task

Route::get('/projects/{id}/milestones', [MilestoneController::class, 'index'])->name('milestones.index');
Route::get('/projects/{id}/milestones/create', [MilestoneController::class, 'create'])->name('milestones.create');
Route::post('/projects/{id}/milestones', [MilestoneController::class, 'store'])->name('milestones.store');
Route::get('/milestones/{milestoneId}/edit', [MilestoneController::class, 'edit'])->name('milestones.edit');
Route::post('/milestones/{milestoneId}', [MilestoneController::class, 'update'])->name('milestones.update'); // Already POST
Route::delete('/milestones/{milestoneId}/delete', [MilestoneController::class, 'destroy'])->name('milestones.destroy'); // Change to DELETE

// Public Routes (Authentication)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (Projects)
// Route::middleware(['auth'])->group(function () {
//     Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
//     Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
//     Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
//     Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
//     Route::post('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
//     Route::get('/projects/{id}/delete', [ProjectController::class, 'destroy'])->name('projects.destroy');
// });