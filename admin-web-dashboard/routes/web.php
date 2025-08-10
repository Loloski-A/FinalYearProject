<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\IncidentController;
use App\Http\Controllers\Backend\ResourceController;
use App\Http\Controllers\Backend\TeamController; // Import the new controller

Route::redirect('/', '/login');

Route::middleware(['auth'])->group(function (){
  Route::get('admin/dashboard', [DashboardController::class,'dashboard']);
  Route::get('admin/resources', [DashboardController::class,'admin_resources'])->name('admin.resources');
  Route::get('admin/incident', [DashboardController::class,'admin_incident']);

  // --- ADDED: Routes for Team Management ---
  Route::get('admin/teams', [TeamController::class, 'index'])->name('admin.teams');
  Route::post('admin/teams/store', [TeamController::class, 'storeTeam'])->name('admin.teams.store');
  Route::post('admin/teams/assign', [TeamController::class, 'assignMember'])->name('admin.teams.assign');
  Route::delete('admin/teams/remove/{member}', [TeamController::class, 'removeMember'])->name('admin.teams.remove');

  // Incident Actions
  Route::post('admin/incident/{incident}/assign', [IncidentController::class, 'assignTeam'])->name('admin.incident.assign');
  Route::put('admin/incident/{incident}', [IncidentController::class, 'update'])->name('admin.incident.update');
  Route::delete('admin/incident/{incident}', [IncidentController::class, 'destroy'])->name('admin.incident.destroy');

  // Resource Actions
  Route::post('admin/resources', [ResourceController::class, 'store'])->name('admin.resources.store');
  Route::put('admin/resources/{resource}', [ResourceController::class, 'update'])->name('admin.resources.update');
  Route::delete('admin/resources/{resource}', [ResourceController::class, 'destroy'])->name('admin.resources.destroy');
});

// Public Auth routes
Route::get ('login', [AuthController::class,'login']);
Route::post ('login_admin', [AuthController::class,'login_admin']);
Route::get ('logout', [AuthController::class,'logout']);
Route::get ('forgot', [AuthController::class,'forgot']);
Route::post('forgot_admin', [AuthController::class, 'forgot_admin']);
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register_admin', [AuthController::class, 'register_admin']);
