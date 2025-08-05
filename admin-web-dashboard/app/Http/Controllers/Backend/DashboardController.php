<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\ResponseTeam;
use App\Models\User;
use App\Models\FirstAidGuide; // Import the FirstAidGuide model

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // This method remains the same
        $totalIncidents = Incident::count();
        $pendingIncidents = Incident::where('status', 'Pending')->count();
        $activeResponseIncidents = Incident::whereIn('status', ['Assigned', 'En Route'])->count();
        $resolvedIncidents = Incident::where('status', 'Resolved')->count();
        $allIncidents = Incident::with('reporter')->orderBy('reported_at', 'desc')->get();
        $responseTeams = ResponseTeam::with('members')->get();
        $incidentLocations = $allIncidents->map(function ($incident) {
            return [
                'lat' => $incident->latitude,
                'lng' => $incident->longitude,
                'type' => $incident->incident_type,
                'severity' => $incident->severity,
                'status' => $incident->status,
            ];
        });

        return view('backend.dashboard.list', [
            'totalIncidents' => $totalIncidents,
            'pendingIncidents' => $pendingIncidents,
            'activeResponseIncidents' => $activeResponseIncidents,
            'resolvedIncidents' => $resolvedIncidents,
            'allIncidents' => $allIncidents,
            'responseTeams' => $responseTeams,
            'incidentLocations' => $incidentLocations,
        ]);
    }

    public function admin_resources(Request $request)
    {
        // --- UPDATED: Fetch all guides and pass to the view ---
        $allGuides = FirstAidGuide::orderBy('title')->get();
        return view('backend.resources.list', ['allGuides' => $allGuides]);
    }

     public function admin_incident(Request $request)
    {
        // This method remains the same
        $totalIncidents = Incident::count();
        $pendingIncidents = Incident::where('status', 'Pending')->count();
        $activeResponseIncidents = Incident::whereIn('status', ['Assigned', 'En Route'])->count();
        $resolvedIncidents = Incident::where('status', 'Resolved')->count();
        $allIncidents = Incident::with('reporter')->orderBy('reported_at', 'desc')->get();
        $responseTeams = ResponseTeam::where('status', 'Active')->get();

        return view('backend.incident.list', [
            'totalIncidents' => $totalIncidents,
            'pendingIncidents' => $pendingIncidents,
            'activeResponseIncidents' => $activeResponseIncidents,
            'resolvedIncidents' => $resolvedIncidents,
            'allIncidents' => $allIncidents,
            'responseTeams' => $responseTeams,
        ]);
    }
}
