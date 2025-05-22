<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/weather', [WeatherController::class, 'getWeather']);
Route::get('/weather/{city?}', [WeatherController::class, 'getWeather'])->name('weather');
