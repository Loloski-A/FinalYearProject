<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\IncidentController;
use App\Http\Controllers\Backend\ResourceController; // Import the new controller

Route::redirect('/', '/login');

Route::middleware(['auth'])->group(function (){
  Route::get('admin/dashboard', [DashboardController::class,'dashboard']);

  // UPDATED: Renamed route for consistency
  Route::get('admin/resources', [DashboardController::class,'admin_resources'])->name('admin.resources');

  Route::get('admin/incident', [DashboardController::class,'admin_incident']);

  // Incident Actions
  Route::post('admin/incident/{incident}/assign', [IncidentController::class, 'assignTeam'])->name('admin.incident.assign');
  Route::put('admin/incident/{incident}', [IncidentController::class, 'update'])->name('admin.incident.update');
  Route::delete('admin/incident/{incident}', [IncidentController::class, 'destroy'])->name('admin.incident.destroy');

  // --- ADDED: Routes for Resource (First Aid Guide) Actions ---
  Route::post('admin/resources', [ResourceController::class, 'store'])->name('admin.resources.store');
  Route::put('admin/resources/{resource}', [ResourceController::class, 'update'])->name('admin.resources.update');
  Route::delete('admin/resources/{resource}', [ResourceController::class, 'destroy'])->name('admin.resources.destroy');
});

Route::get ('login', [AuthController::class,'login']);
Route::post ('login_admin', [AuthController::class,'login_admin']);
Route::get ('logout', [AuthController::class,'logout']);
Route::get ('forgot', [AuthController::class,'forgot']);
Route::post('forgot_admin', [AuthController::class, 'forgot_admin']);
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register_admin', [AuthController::class, 'register_admin']);
