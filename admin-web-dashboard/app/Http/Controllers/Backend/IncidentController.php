<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\ResponseTeam;
use App\Models\IncidentAssignment;

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

        return redirect()->back()->with('success', 'Team has been assigned successfully.');
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

        return redirect()->back()->with('success', 'Incident updated successfully.');
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
