<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class ApiAuthController extends Controller
{
    /**
     * Handle user login for mobile apps (bystander and response team).
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // Delete existing tokens to ensure only one active token per device/login
            $user->tokens()->delete();

            // Create a new API token for the user
            $token = $user->createToken($request->email . '_AuthToken')->plainTextToken;

            // Determine the dashboard based on user role
            $redirect_route = '';
            switch ($user->is_role) {
                case 0: // Bystander
                    $redirect_route = 'bystander/dashboard'; // Placeholder for mobile app's internal route
                    break;
                case 1: // Admin (though admins typically use web dashboard)
                    $redirect_route = 'admin/dashboard'; // Placeholder
                    break;
                case 2: // Response Team Member
                    $redirect_route = 'team/dashboard'; // Placeholder for mobile app's internal route
                    break;
                default:
                    // Handle unknown role or restrict access
                    $user->tokens()->delete(); // Revoke token for unknown roles
                    return response()->json(['message' => 'Account role not recognized or unauthorized.'], 403);
            }

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'redirect_to' => $redirect_route // Inform mobile app where to navigate
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('API Login Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred during login. Please try again.'
            ], 500);
        }
    }

    /**
     * Register a new bystander user.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerBystander(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_role' => 0, // 0 for Bystander
                'status' => 1,  // Active by default upon registration
                'email_verified_at' => now(), // Mark as verified immediately for simplicity
            ]);

            // Generate token for immediate login after registration
            $token = $user->createToken($request->email . '_AuthToken')->plainTextToken;

            return response()->json([
                'message' => 'Bystander registered successfully',
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Bystander Registration Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred during registration. Please try again.'
            ], 500);
        }
    }

    /**
     * Register a new response team member.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerTeamMember(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'team_type' => 'required|string|max:255', // e.g., Fire Brigade, Medical
                // You might need a 'team_id' here if members are assigned to existing teams during registration
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_role' => 2, // 2 for Response Team Member
                'status' => 1,  // Active by default upon registration
                'email_verified_at' => now(), // Mark as verified immediately
            ]);

            // TODO: Link this user to a specific 'response_teams' entry via the 'team_members' table.
            // This might involve fetching an existing team_id or creating a new team if it's the first member.
            // For now, we'll just create the user.

            // Generate token for immediate login after registration
            $token = $user->createToken($request->email . '_AuthToken')->plainTextToken;

            return response()->json([
                'message' => 'Team member registered successfully',
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Team Member Registration Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred during registration. Please try again.'
            ], 500);
        }
    }

    /**
     * Log out the authenticated user by revoking their current token.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged out successfully'], 200);
        }
        return response()->json(['message' => 'No active user session'], 401);
    }

    /**
     * Get the authenticated user's details.
     * This method is already covered by the default /api/user route provided by Sanctum.
     * You can keep it here if you want to add custom logic or remove it.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
