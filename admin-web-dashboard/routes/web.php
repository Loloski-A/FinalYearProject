<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware(['auth'])->group(function (){

  Route::get('admin/dashboard', [DashboardController::class,'dashboard']);

  Route::get('admin/resources', [DashboardController::class,'admin_resources']);

  Route::get('admin/incident', [DashboardController::class,'admin_incident']);

});

Route::get ('login', [AuthController::class,'login']);

Route::post ('login_admin', [AuthController::class,'login_admin']);

Route::get ('logout', [AuthController::class,'logout']);

Route::get ('forgot', [AuthController::class,'forgot']);

Route::post('forgot_admin', [AuthController::class, 'forgot_admin']);

