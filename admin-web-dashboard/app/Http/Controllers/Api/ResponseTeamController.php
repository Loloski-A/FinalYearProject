<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incident; // Import Incident model
use App\Models\ResponseTeam; // Import ResponseTeam model
use App\Models\TeamMember; // Import TeamMember model
use App\Models\IncidentAssignment; // Import IncidentAssignment model
use App\Models\Notification; // Import Notification model
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class ResponseTeamController extends Controller
{
    /**
     * Get incidents assigned to the authenticated response team member's team.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAssignedIncidents(Request $request)
    {
        $user = $request->user(); // Authenticated team member

        // Find the team this member belongs to
        $teamMember = TeamMember::where('user_id', $user->id)->first();

        if (!$teamMember) {
            return response()->json(['message' => 'User is not assigned to any team.'], 404);
        }

        // UPDATED: Changed the eager loading to include the incident's reporter.
        // This is called "nested eager loading".
        $assignedIncidents = IncidentAssignment::where('team_id', $teamMember->team_id)
                                            ->with('incident.reporter') // This now loads the reporter as well
                                            ->orderBy('assigned_at', 'desc')
                                            ->get();

        return response()->json([
            'message' => 'Assigned incidents fetched successfully',
            'incidents' => $assignedIncidents->map(function($assignment) {
                // Now, $assignment->incident will have the 'reporter' object attached
                return $assignment->incident;
            })
        ], 200);
    }

    /**
     * Get detailed information for a specific incident.
     * @param Request $request
     * @param int $id The incident ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIncidentDetails(Request $request, $id)
    {
        $incident = Incident::find($id);

        if (!$incident) {
            return response()->json(['message' => 'Incident not found'], 404);
        }

        // Optional: Add logic to ensure the incident is assigned to the requesting team member's team
        // $user = $request->user();
        // $teamMember = TeamMember::where('user_id', $user->id)->first();
        // $assignment = IncidentAssignment::where('incident_id', $id)->where('team_id', $teamMember->team_id)->first();
        // if (!$assignment) {
        //     return response()->json(['message' => 'Unauthorized access to incident details'], 403);
        // }

        return response()->json([
            'message' => 'Incident details fetched successfully',
            'incident' => $incident
        ], 200);
    }

      /**
     * Update the status of an assigned incident.
     * @param Request $request
     * @param int $id The incident ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateIncidentStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:Assigned,En Route,Arrived,Completed,Cancelled,Resolved',
                'notes' => 'nullable|string',
            ]);

            $incident = Incident::find($id);
            if (!$incident) {
                return response()->json(['message' => 'Incident not found'], 404);
            }

            // --- DATABASE AND STATUS UPDATE ---
            // Update the incident's main status
            $incident->status = $request->status;
            if ($request->status === 'Resolved' || $request->status === 'Completed') {
                $incident->resolved_at = now();
            }
            $incident->save();

            // Also update the status in the specific assignment record
            $user = $request->user();
            $teamMember = TeamMember::where('user_id', $user->id)->first();
            if ($teamMember) {
                $assignment = IncidentAssignment::where('incident_id', $id)
                                                ->where('team_id', $teamMember->team_id)
                                                ->first();
                if ($assignment) {
                    $assignment->status = $request->status;
                    $assignment->notes = $request->notes ?? $assignment->notes;
                    $assignment->save();
                }
            }

            // --- DYNAMIC NOTIFICATION LOGIC FOR BYSTANDER ---
            // 1. Delete any previous status update notifications for this incident to avoid clutter.
            Notification::where('incident_id', $incident->id)
                        ->where('user_id', $incident->user_id) // Ensure we only delete for the original reporter
                        ->where('type', 'Status Update') // Only delete status updates, not the initial "Help is on the way!" message
                        ->delete();

            // 2. Create a new, up-to-date notification for the bystander.
            Notification::create([
                'user_id' => $incident->user_id, // Target the bystander who reported the incident
                'incident_id' => $incident->id,
                'title' => 'Incident Status Updated',
                'message' => 'The status of the incident you reported ("' . $incident->incident_type . '") has been updated to: ' . $request->status . '.',
                'type' => 'Status Update',
            ]);


            return response()->json([
                'message' => 'Incident status updated successfully and bystander notified.',
                'incident' => $incident
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Update Incident Status Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while updating incident status. Please try again.'
            ], 500);
        }
    }

     /**
     * Get the profile of the authenticated response team's team.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTeamProfile(Request $request)
    {
        $user = $request->user();

        // Find the TeamMember record for the currently authenticated user
        $teamMember = TeamMember::where('user_id', $user->id)->first();

        if (!$teamMember) {
            return response()->json(['message' => 'User is not assigned to any team.'], 404);
        }

        // UPDATED: Fetch the team and use withCount to get the number of members.
        // Laravel will automatically create a 'members_count' attribute.
        $teamProfile = ResponseTeam::withCount('members')->find($teamMember->team_id);

        if (!$teamProfile) {
            return response()->json(['message' => 'Team profile not found.'], 404);
        }

        return response()->json([
            'message' => 'Team profile fetched successfully',
            'team_profile' => $teamProfile
        ], 200);
    }

    /**
     * Get notifications for the authenticated response team member's team.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNotifications(Request $request)
    {
        $user = $request->user();
        $teamMember = TeamMember::where('user_id', $user->id)->first();

        if (!$teamMember) {
            return response()->json(['message' => 'User is not assigned to any team.'], 404);
        }

        // --- FIXED LOGIC ---
        // This query now ONLY fetches notifications where the team_id
        // explicitly matches the logged-in user's team ID.
        $notifications = Notification::where('team_id', $teamMember->team_id)
                                    ->orderBy('sent_at', 'desc')
                                    ->get();

        return response()->json([
            'message' => 'Team notifications fetched successfully',
            'notifications' => $notifications
        ], 200);
    }
    // You can add more methods here as needed, e.g., updateTeamMemberStatus, manageTeamResources, etc.
}
