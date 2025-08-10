<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResponseTeam;
use App\Models\TeamMember;
use App\Models\User;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all users who are registered as team members but are not yet in the team_members table
        $unassignedMembers = User::where('is_role', 2)
                                 ->whereNotIn('id', function($query) {
                                     $query->select('user_id')->from('team_members');
                                 })
                                 ->get();

        $allTeams = ResponseTeam::with('members.user')->get();

        return view('backend.teams.list', [
            'unassignedMembers' => $unassignedMembers,
            'allTeams' => $allTeams
        ]);
    }

    /**
     * Store a newly created team in storage.
     */
    public function storeTeam(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:response_teams',
            'team_type' => 'required|string|max:255',
            'contact_phone' => 'nullable|string|max:255',
        ]);

        ResponseTeam::create($request->all());

        return redirect()->back()->with('success', 'New response team created successfully.');
    }

    /**
     * Assign a user to a team.
     */
    public function assignMember(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'team_id' => 'required|exists:response_teams,id',
            'role' => 'required|string|max:255',
        ]);

        TeamMember::create($request->all());

        return redirect()->back()->with('success', 'Team member assigned successfully.');
    }

    /**
     * Remove a member from a team.
     */
    public function removeMember(TeamMember $member)
    {
        $member->delete();
        return redirect()->back()->with('success', 'Team member removed successfully.');
    }
}
