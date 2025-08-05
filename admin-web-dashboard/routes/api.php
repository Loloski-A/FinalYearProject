<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import your custom API controllers
use App\Http\Controllers\Api\BystanderController;
use App\Http\Controllers\Api\ResponseTeamController;
use App\Http\Controllers\Api\ApiAuthController as ApiAuthController; // Alias to avoid conflict with Backend AuthController


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where I can register API routes for my application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group.
|
*/

// Public API Routes (No authentication required yet, e.g., for initial login/registration)
Route::post('/register/bystander', [ApiAuthController::class, 'registerBystander']);
Route::post('/register/team-member', [ApiAuthController::class, 'registerTeamMember']);
Route::post('/login', [ApiAuthController::class, 'login']); // Unified login for both mobile apps

// Routes that require authentication (e.g., using Laravel Sanctum for API tokens)
Route::middleware('auth:sanctum')->group(function () {

    // User profile endpoint (can be accessed by any authenticated user)
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [ApiAuthController::class, 'logout']);

    // Bystander App API Routes
    Route::prefix('bystander')->group(function () {
        // Middleware to ensure only bystanders can access these routes (create this later)
        // Route::middleware('bystander.role')->group(function () {
            Route::post('/report-incident', [BystanderController::class, 'reportIncident']);
            Route::get('/my-reports', [BystanderController::class, 'getMyReports']);
            Route::get('/notifications', [BystanderController::class, 'getNotifications']);
            Route::get('/first-aid-guides', [BystanderController::class, 'getFirstAidGuides']);
            Route::get('/all-incidents', [BystanderController::class, 'getAllIncidents']);
            // Add more bystander-specific routes as needed (e.g., update report, view map)
        // });
    });

    // Response Team App API Routes
    Route::prefix('team')->group(function () {
        // Middleware to ensure only response team members can access these routes (create this later)
        // Route::middleware('team.role')->group(function () {
            Route::get('/dashboard/incidents', [ResponseTeamController::class, 'getAssignedIncidents']);
            Route::get('/incident/{id}', [ResponseTeamController::class, 'getIncidentDetails']);
            Route::post('/incident/{id}/update-status', [ResponseTeamController::class, 'updateIncidentStatus']);
            Route::get('/profile', [ResponseTeamController::class, 'getTeamProfile']);
            Route::get('/notifications', [ResponseTeamController::class, 'getNotifications']);
            // Add more response team-specific routes as needed (e.g., team member updates, resource management)
        // });
    });

    // Admin-specific API routes (if needed for the mobile apps, e.g., for specific admin features)
    Route::prefix('admin-api')->group(function () {
        // Route::middleware('admin.role')->group(function () {
            // Example: API for mobile app to fetch overall stats
            // Route::get('/stats', [AdminApiController::class, 'getDashboardStats']);
        // });
    });

});

// Routes for external API integrations (e.g., Google Maps Geocoding if you need server-side calls)
// These might not always be direct API endpoints for your mobile apps, but rather server-side calls
// that your Laravel backend makes to external services.
Route::prefix('external')->group(function () {
    // Example: A route your mobile app calls, which then calls Google Maps Geocoding API
    // Route::get('/geocode', [ExternalApiController::class, 'geocodeAddress']);
});

