<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get ('login', [AuthController::class,'login']);

Route::get ('forgot', [AuthController::class,'forgot']);

Route::get('admin/dashboard', [DashboardController::class,'dashboard']);
