<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\Grant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MilestoneController extends Controller
{
    public function index(Grant $grant)
    {
        $grants = Grant::whereHas('academicians', function ($query) {
            $query->where('user_id', Auth::id())
                  ->where(function ($query) {
                      $query->where('role', 'like', '%member%')
                            ->orWhere('role', 'like', '%leader%');
                  });
        })->get();

        $milestones = Milestone::all();
        /*$user = auth()->user();
        $milestones = Milestone::whereHas('grant', function ($query) use ($user) {
        $query->where('leader_id', $user->academician_id);
        })->with('grant')->get();
        $grant = Grant::find($request->grant_id); 
        //$milestones = Milestone::with('grant')->get(); */ //Fetch all milestones with their associated grants       
        return view('milestones.index', compact('milestones','grant')); // Pass milestones to the view
    }

    public function create()
    {
        $grants = Grant::all(); // Fetch all grants for the dropdown
        return view('milestones.create', compact('grants'));

    /*if ($grants->isEmpty()) {
        abort(403, 'You are not authorized to create milestones.');
    }*/

        //return view('milestones.create', compact('grants')); // Pass grants to the create view
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'milestone_title' => 'required|string|max:255',
            'completion_date' => 'required|date',
            'deliverable' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'remark' => 'nullable|string|max:255',
            'grant_id' => 'required|exists:grants,id', // Ensure the grant exists
        ]);
        /*$grant = Grant::find($validatedData['grant_id']);

    // Ensure the logged-in user is the leader of the grant
    if ($grant->leader_id !== auth()->user()->academician_id) {
        abort(403, 'You are not authorized to add milestones for this grant.');
    }*/
        Milestone::create($validatedData); // Create a milestone with validated data

        return redirect()->route('milestones.index')->with('success', 'Milestone created successfully.');
    }

    public function show(Milestone $milestone)
    {
        return view('milestones.show', compact('milestone')); // Pass the milestone to the view
    }

    public function edit(Milestone $milestone)
    {
        $grants = Grant::all(); // Fetch all grants for editing
        return view('milestones.edit', compact('milestone', 'grants'));
    }

    public function update(Request $request, Milestone $milestone)
    {
        $validatedData = $request->validate([
            'milestone_title' => 'required|string|max:255',
            'completion_date' => 'required|date',
            'deliverable' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'remark' => 'nullable|string|max:255',
            'grant_id' => 'required|exists:grants,id', // Ensure the grant exists
        ]);

        $milestone->update([
            'milestone_title' => $validatedData['milestone_title'],
            'completion_date' => $validatedData['completion_date'],
            'deliverable' => $validatedData['deliverable'],
            'status' => $validatedData['status'],
            'remark' => $validatedData['remark'] ?? 'No comments provided',  // Default if no remark is given
            'grant_id' => $validatedData['grant_id'],
            //'date_updated' => $validatedData['date_updated'],
        ]);
        return redirect()->route('milestones.index', $milestone->grant_id)->with('success', 'Milestone updated successfully.');
    }

    public function destroy(Milestone $milestone)
    {
        $milestone->delete(); // Delete the milestone
        return redirect()->route('milestones.index')->with('success', 'Milestone deleted successfully.');
    }
}
