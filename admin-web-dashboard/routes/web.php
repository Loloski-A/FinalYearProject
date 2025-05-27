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

Route::get('admin/home', [DashboardController::class,'admin_home']);

Route::get('admin/resources', [DashboardController::class,'admin_resources']);

Route::get('admin/incident', [DashboardController::class,'admin_incident']);
