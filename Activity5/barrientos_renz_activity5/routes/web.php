<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;

Route::get('/{operator}/{num1}/{num2}/{operator2}/{num3}/{num4}', [MyController::class, 'calculate']); //ito naman yung route, yung operator yun yung ipapasa nya dun sa MyController kung anong operator yung gagamitin, yung num1 and num2 naman yung ipapasa nyang input tas yung calculate yung yung name nung buong method dun sa may MyController