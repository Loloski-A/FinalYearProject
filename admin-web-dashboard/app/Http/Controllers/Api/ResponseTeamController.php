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

        // Get incidents assigned to this team
        $assignedIncidents = IncidentAssignment::where('team_id', $teamMember->team_id)
                                            ->with('incident') // Eager load incident details
                                            ->orderBy('assigned_at', 'desc')
                                            ->get();

        return response()->json([
            'message' => 'Assigned incidents fetched successfully',
            'incidents' => $assignedIncidents->map(function($assignment) {
                return $assignment->incident; // Return just the incident details
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

            // Optional: Verify that the requesting team member is authorized to update this incident
            // $user = $request->user();
            // $teamMember = TeamMember::where('user_id', $user->id)->first();
            // $assignment = IncidentAssignment::where('incident_id', $id)->where('team_id', $teamMember->team_id)->first();
            // if (!$assignment) {
            //     return response()->json(['message' => 'Unauthorized to update this incident'], 403);
            // }

            $incident->status = $request->status;
            if ($request->status === 'Resolved' || $request->status === 'Completed') {
                $incident->resolved_at = now();
            }
            $incident->save();

            // Update the status in the incident_assignments table as well
            $assignment = IncidentAssignment::where('incident_id', $id)
                                            ->where('team_id', $request->user()->teamMember->team_id) // Assuming teamMember relation is set up
                                            ->first();
            if ($assignment) {
                $assignment->status = $request->status;
                $assignment->notes = $request->notes ?? $assignment->notes;
                $assignment->save();
            }


            return response()->json([
                'message' => 'Incident status updated successfully',
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
        $teamMember = TeamMember::where('user_id', $user->id)->with('team')->first(); // Eager load the team relationship

        if (!$teamMember || !$teamMember->team) {
            return response()->json(['message' => 'Team profile not found or user not assigned to a team.'], 404);
        }

        return response()->json([
            'message' => 'Team profile fetched successfully',
            'team_profile' => $teamMember->team
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

        $notifications = Notification::where('team_id', $teamMember->team_id)
                                    ->orWhereNull('team_id') // For general broadcasts
                                    ->orderBy('sent_at', 'desc')
                                    ->get();

        return response()->json([
            'message' => 'Team notifications fetched successfully',
            'notifications' => $notifications
        ], 200);
    }

    // You can add more methods here as needed, e.g., updateTeamMemberStatus, manageTeamResources, etc.
}
