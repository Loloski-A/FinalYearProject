<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incident; // Make sure to import your Incident model
use App\Models\FirstAidGuide; // Make sure to import your FirstAidGuide model
use App\Models\Notification; // Make sure to import your Notification model
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
            $request->validate([
                'incident_type' => 'required|string|max:255',
                'severity' => 'required|in:Critical,High,Medium,Low',
                'description' => 'required|string',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'location_name' => 'nullable|string|max:255',
                'contact_info' => 'nullable|string|max:255',
                // 'media_files' => 'nullable|array', // For file uploads, requires different handling
                // 'media_files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Example validation for images
            ]);

            // Get the authenticated user (bystander)
            $user = $request->user();

            $incident = Incident::create([
                'user_id' => $user->id,
                'incident_type' => $request->incident_type,
                'severity' => $request->severity,
                'description' => $request->description,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'location_name' => $request->location_name,
                'contact_info' => $request->contact_info,
                'status' => 'Pending', // Default status for new reports
                'reported_at' => now(),
            ]);

            // TODO: Handle media file uploads (requires storage setup and file processing)
            // if ($request->hasFile('media_files')) {
            //     foreach ($request->file('media_files') as $file) {
            //         $path = $file->store('incident_media', 'public'); // Store in 'storage/app/public/incident_media'
            //         IncidentMedia::create([
            //             'incident_id' => $incident->id,
            //             'file_path' => $path,
            //             'file_type' => str_contains($file->getMimeType(), 'video') ? 'video' : 'image',
            //         ]);
            //     }
            // }

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
            Log::error('Report Incident Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while reporting the incident. Please try again.'
            ], 500);
        }
    }

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
        $notifications = Notification::where('user_id', $user->id)
                                    ->orWhereNull('user_id') // For general broadcasts
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

    // You can add more methods here as needed, e.g., updateMyReport, getIncidentMapData, etc.
}
