<?php

namespace App\Http\Controllers;

use App\Models\CommunityProgram;
use Illuminate\Http\Request;

class CommunityProgramController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Team Leader') {
            $programs = CommunityProgram::where('team_leader_id', auth()->user()->id)->get();
        } else {
            $programs = CommunityProgram::with('teamLeader')->get();
        }

        return view('dashboard.programs.index', compact('programs'));
    }

    public function create()
    {
        // Only team leaders can create programs
        if (auth()->user()->role !== 'Team Leader') {
            return redirect()->back()->with('error', 'Only Team Leaders can create community programs');
        }

        return view('dashboard.programs.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'Team Leader') {
            return redirect()->back()->with('error', 'Only Team Leaders can create community programs');
        }

        $request->validate([
            'program_name' => 'required|string|max:255',
            'description' => 'required|string',
            'support_needed' => 'required|string',
            'event_date' => 'required|date|after:today',
            'location' => 'required|string|max:255',
            'proposal' => 'required|file|mimes:pdf|max:10240'
        ]);

        $proposalPath = null;
        if ($request->hasFile('proposal')) {
            $proposal = $request->file('proposal');
            $proposalName = time() . '_' . $proposal->getClientOriginalName();
            $proposalPath = $proposal->storeAs('proposals', $proposalName, 'public');
        }

        CommunityProgram::create([
            'team_leader_id' => auth()->user()->id,
            'program_name' => $request->program_name,
            'description' => $request->description,
            'support_needed' => $request->support_needed,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'proposal' => $proposalPath
        ]);

        return redirect()->route('dashboard.programs')->with('success', 'Community program proposal submitted successfully');
    }

    public function show($id)
    {
        $program = CommunityProgram::with('teamLeader')->findOrFail($id);

        // Team leaders can only view their own programs
        if (auth()->user()->role == 'Team Leader' && $program->team_leader_id != auth()->user()->id) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        return view('dashboard.programs.show', compact('program'));
    }

    public function approve($id)
    {
        // Only superusers can approve programs
        if (auth()->user()->role !== 'superuser') {
            return redirect()->back()->with('error', 'Only administrators can approve programs');
        }

        $program = CommunityProgram::findOrFail($id);
        $program->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Program approved successfully');
    }

    public function reject($id)
    {
        // Only superusers can reject programs
        if (auth()->user()->role !== 'superuser') {
            return redirect()->back()->with('error', 'Only administrators can reject programs');
        }

        $program = CommunityProgram::findOrFail($id);
        $program->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Program rejected');
    }
}
