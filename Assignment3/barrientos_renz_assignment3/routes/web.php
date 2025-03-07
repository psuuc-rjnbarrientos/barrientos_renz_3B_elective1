<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [FormController::class, 'showForm']) ->name('/');

Route::post('/',[FormController::class,'handleForm']);