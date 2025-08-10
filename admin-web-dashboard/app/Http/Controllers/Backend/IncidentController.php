<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\ResponseTeam;
use App\Models\IncidentAssignment;
use App\Models\Notification;

class IncidentController extends Controller
{
    /**
     * Assign a response team to an incident.
     */
    public function assignTeam(Request $request, Incident $incident)
    {
        $request->validate([
            'team_id' => 'required|exists:response_teams,id',
        ]);

        // Create the assignment record
        IncidentAssignment::create([
            'incident_id' => $incident->id,
            'team_id' => $request->team_id,
            'status' => 'Assigned',
        ]);

        // Update the incident's status
        $incident->status = 'Assigned';
        $incident->save();

        // --- FIXED NOTIFICATION LOGIC ---

        // 1. Create a clear, specific notification for the BYSTANDER (User)
        // This notification is targeted by 'user_id' and has a message for the bystander.
        Notification::create([
            'user_id' => $incident->user_id, // Targets the user who reported
            'incident_id' => $incident->id,
            'title' => 'Help is on the way!',
            'message' => 'A response team has been assigned to the incident you reported: "' . $incident->incident_type . '".',
            'type' => 'Status Update',
        ]);

        // 2. Create a separate, detailed notification for the RESPONSE TEAM
        // This notification is targeted by 'team_id' and has a message for the team.
        Notification::create([
            'team_id' => $request->team_id, // Targets the assigned team
            'incident_id' => $incident->id,
            'title' => 'New Incident Assigned',
            'message' => 'Your team has been assigned to a new incident: "' . $incident->incident_type . '" at ' . $incident->location_name,
            'type' => 'New Assignment',
        ]);

        return redirect()->back()->with('success', 'Team has been assigned successfully and notifications have been sent.');
    }

    /**
     * Update the specified incident in storage.
     */
    public function update(Request $request, Incident $incident)
    {
        $validatedData = $request->validate([
            'incident_type' => 'required|string|max:255',
            'status' => 'required|in:Pending,Assigned,En Route,Resolved,Closed',
            'severity' => 'required|in:Critical,High,Medium,Low',
            'location_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $incident->update($validatedData);

        // This notification is also for the bystander and is correct.
        Notification::create([
            'user_id' => $incident->user_id,
            'incident_id' => $incident->id,
            'title' => 'Incident Status Updated',
            'message' => 'The status of your reported incident "' . $incident->incident_type . '" has been updated to: ' . $incident->status . '.',
            'type' => 'Status Update',
        ]);

        return redirect()->back()->with('success', 'Incident updated and a notification has been sent.');
    }

    /**
     * Remove the specified incident from storage.
     */
    public function destroy(Incident $incident)
    {
        $incident->delete();
        return redirect()->back()->with('success', 'Incident deleted successfully.');
    }
}
