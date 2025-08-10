<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\FirstAidGuide;
use App\Models\Notification;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class BystanderController extends Controller
{
    /**
     * Report a new incident.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportIncident(Request $request)
    {
        try {
            // The validated() method returns an array of only the data that passed validation.
            $validatedData = $request->validate([
                'incident_type' => 'required|string|max:255',
                'severity' => 'required|in:Critical,High,Medium,Low',
                'description' => 'required|string',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'location_name' => 'nullable|string|max:255',
            ]);

            $user = $request->user();

            // *** FIXED: Merge validated data with server-set data ***
            // This is a safer way to create the record, preventing errors
            // from fields that might not be in the request.
            $incidentData = array_merge($validatedData, [
                'user_id' => $user->id,
                'status' => 'Pending',
                'reported_at' => now(),
            ]);

            $incident = Incident::create($incidentData);

            return response()->json([
                'message' => 'Incident reported successfully!',
                'incident' => $incident
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // If the error persists, this log will contain the exact reason.
            Log::error('Report Incident Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while reporting the incident. Please try again.'
            ], 500);
        }
    }

    // ... other methods in the controller remain the same ...
    /**
     * Get incident reports submitted by the authenticated bystander.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMyReports(Request $request)
    {
        $user = $request->user();
        $myReports = Incident::where('user_id', $user->id)
                            ->orderBy('reported_at', 'desc')
                            ->get();

        return response()->json([
            'message' => 'My reports fetched successfully',
            'reports' => $myReports
        ], 200);
    }

    /**
     * Get notifications for the authenticated bystander.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
     public function getNotifications(Request $request)
    {
        $user = $request->user();

        // --- FIXED LOGIC ---
        // This query now ONLY fetches notifications where the user_id
        // explicitly matches the logged-in bystander's ID.
        $notifications = Notification::where('user_id', $user->id)
                                    ->orderBy('sent_at', 'desc')
                                    ->get();

        return response()->json([
            'message' => 'Notifications fetched successfully',
            'notifications' => $notifications
        ], 200);
    }

    /**
     * Get first aid guides.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFirstAidGuides(Request $request)
    {
        $guides = FirstAidGuide::orderBy('title')->get();

        return response()->json([
            'message' => 'First Aid Guides fetched successfully',
            'guides' => $guides
        ], 200);
    }

   /**
     * Get all recent incidents for the main dashboard.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllIncidents(Request $request)
    {
        // Fetch the 10 most recent incidents regardless of who reported them
        $recentIncidents = Incident::orderBy('reported_at', 'desc')
                                    ->take(10)
                                    ->get();

        return response()->json([
            'message' => 'Recent incidents fetched successfully',
            'incidents' => $recentIncidents
        ], 200);
    }
}
