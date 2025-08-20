<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Team Leader') {
            $members = TeamMember::where('team_leader_id', auth()->user()->id)->get();
        } else {
            // if the user is an admin or superuser get all team_leaders
            $members = User::where('role', 'Team Leader')->get();
        }

        return view('dashboard.members.index', compact('members'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'Team Leader') {
            return redirect()->back()->with('error', 'Only Team Leaders can add members');
        }

        return view('dashboard.members.create');
    }

    public function show($id)
    {
        $teamLeader = User::where('role', 'Team Leader')->findOrFail($id);
        $members = TeamMember::where('team_leader_id', $id)->get();

        return view('dashboard.members.show', compact('teamLeader', 'members'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'Team Leader') {
            return redirect()->back()->with('error', 'Only Team Leaders can add members');
        }

        $request->validate([
            'members' => 'required|array|min:1',
            'members.*.name' => 'required|string|max:255',
            'members.*.phone_number' => 'required|string|max:20'
        ], [
            'members.min' => 'You must submit at least 1 member'
        ]);

        foreach ($request->members as $memberData) {
            TeamMember::create([
                'team_leader_id' => auth()->user()->id,
                'name' => $memberData['name'],
                'phone_number' => $memberData['phone_number']
            ]);
        }

        return redirect()->route('dashboard.members')->with('success', 'Team members submitted successfully');
    }

    public function destroy($id)
    {
        $member = TeamMember::findOrFail($id);

        // Team leaders can only delete their own members
        if (auth()->user()->role == 'Team Leader' && $member->team_leader_id != auth()->user()->id) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        $member->delete();
        return redirect()->back()->with('success', 'Member removed successfully');
    }
}
