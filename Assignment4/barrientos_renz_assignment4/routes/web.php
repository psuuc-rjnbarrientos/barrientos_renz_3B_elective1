<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudUpdateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('insert', [StudentController::class, 'insertForm']);

Route::get('view-records', [StudentController::class, 'select']);

Route::post('create', [StudentController::class, 'insert']);

Route::get('delete/{id}', [StudentController::class, 'destroy']);

// Route::get('edit-records', [StudUpdateController::class, 'index']);

Route::get('edit/{id}', [StudentController::class, 'show']);

Route::post('edit/{id}', [StudentController::class, 'edit']);
