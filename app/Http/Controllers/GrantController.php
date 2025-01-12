<?php

namespace App\Http\Controllers;
use App\Models\Grant;
use App\Models\Academician;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class GrantController extends Controller
{
    public function index()
    {
        $grants = Grant::with('leader')->get(); // Eager load leader relationship
        return view('grants.index', compact('grants'));
    }

    public function create()
    {
        $academicians = Academician::all(); // Fetch all academicians
        return view('grants.create', compact('academicians'));
    }

        public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'grant_amount' => 'required|numeric',
            'grant_provider' => 'required|string|max:255',
            'project_description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'duration' => 'required|integer',
            'leader_id' => 'required|exists:academicians,id',
            'members' => 'array',
            'members.*' => 'exists:academicians,id', // Validate members
            
        ]);
        // Create a new grant
        $grant = Grant::create([
            'grant_amount' => $request->grant_amount,
            'grant_provider' => $request->grant_provider,
            'title' => $request->title,
            'project_description' => $request->project_description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'duration' => $request->duration,
            'leader_id' => $request->leader_id,  // Add leader_id to the grant creation
            'members' => 'nullable|array',
            'members.*' => 'exists:academicians,id', // Validate members
        ]);

         // Attach the project leader to the grant
         $grant->academicians()->attach($request->leader_id, ['role' => 'leader']);

         // Attach the project members to the grant with role as member
         if ($request->has('members')) {
             foreach ($request->members as $member) {
                 $grant->academicians()->attach($member, ['role' => 'member']);
             }
         }
 
         // Redirect to the grants index page with a success message
         return redirect()->route('grants.index')->with('success', 'Grant created successfully.');
        /*$grant = Grant::create($validatedData);

        // Attach the leader
        $grant->academicians()->attach($validatedData['leader_id'], ['role' => 'leader']);

        // Attach members
        if (!empty($validatedData['members'])) {
            foreach ($validatedData['members'] as $member) {
                $grant->academicians()->attach($member, ['role' => 'member']);
            }
        }

        return redirect()->route('grants.index')->with('success', 'Grant created successfully.');*/
    }


    public function show(Grant $grant)
{
    // Fetch members and milestones
    $members = $grant->academicians()->wherePivot('role', 'member')->get();
    $milestones = $grant->milestones;

    // Check if the logged-in user is the leader or member
    $isLeader = $grant->leader_id == auth()->user()->academician_id;

    return view('grants.show', compact('grant', 'members', 'milestones', 'isLeader'));
}



    public function edit(Grant $grant)
    {
        /* Check if the logged-in user is the leader of the grant
        if (Gate::denies('staffAdmin', $grant)) {
            abort(403, 'You are not authorized to edit this grant');
        }*/
        $academicians = Academician::all();
        $members = $grant->academicians()->wherePivot('role', 'member')->get();
        return view('grants.edit', compact('grant', 'academicians', 'members'));
    }

    public function update(Request $request, Grant $grant)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'grant_amount' => 'required|numeric',
        'grant_provider' => 'required|string|max:255',
        'project_description' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'duration' => 'required|integer',
        'leader_id' => 'required|exists:academicians,id', // Validate leader_id
        'members' => 'nullable|array',
        'members.*' => 'exists:academicians,id', // Validate members
    ]);

    // Get the selected members
    $selectedMemberIds = $request->input('members', []);

    // Prepare sync data with roles
    $syncData = [];

    // Add the leader to the sync data (if a leader is selected)
    if ($request->has('leader_id') && $request->leader_id) {
        // Update the leader_id in the grant table
        $grant->leader_id = $request->leader_id;
        $syncData[$request->leader_id] = ['role' => 'leader']; // Sync leader
    }

    // Add members with 'member' role
    foreach ($selectedMemberIds as $memberId) {
        $syncData[$memberId] = ['role' => 'member'];  // Sync members
    }

    // Sync project members with roles
    $grant->academicians()->sync($syncData);

    // Update the grant record with validated data
    $grant->update($validatedData);

    // Redirect to the grants index page with a success message
    return redirect()->route('grants.index')->with('success', 'Grant updated successfully.');

    /*Update the grant details
    $grant->update($validatedData);

    // Update project leader in the pivot table
    $syncData = [];
    if ($request->has('leader_id') && $request->leader_id) {
        $syncData[$request->leader_id] = ['role' => 'leader']; // Add leader to sync data
    }

    // Update project members in the pivot table
    if ($request->has('members')) {
        foreach ($request->members as $memberId) {
            $syncData[$memberId] = ['role' => 'member'];
        }
    }

    // Sync the pivot table (updates leader and members)
    $grant->academicians()->sync($syncData);
    return redirect()->route('grants.index')->with('success', 'Grant updated successfully.');*/
}


    public function destroy(Grant $grant)
    {
        $grant->delete();
        return redirect()->route('grants.index')->with('success', 'Grant deleted successfully.');
    }
}

    /*public function update(Request $request, Grant $grant)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'grant_amount' => 'required|numeric',
            'grant_provider' => 'required|string|max:255',
            'project_description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'duration' => 'required|integer',
            'leader_id' => 'required|exists:academicians,id', // Validate leader_id
        ]);

        Update the grant
        $grant->update($validatedData);
        if ($request->has('leader_id') && $request->leader_id) {
            // Update the leader_id in the grant table
            //$grant->leader_id = $request->leader_id;
            $syncData[$request->leader_id] = ['role' => 'leader']; // Sync leader
        }

        return redirect()->route('grants.index')->with('success', 'Grant updated successfully.');
        
    /*public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'grant_amount' => 'required|numeric',
            'grant_provider' => 'required|string|max:255',
            'project_description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'duration' => 'required|integer',
            'leader_id' => 'required|exists:academicians,id', // Validate leader_id
        ]);

        // Save the grant with the leader_id
        Grant::create($validatedData);

        return redirect()->route('grants.index')->with('success', 'Grant created successfully.');
    }*/

    /*public function show(Grant $grant)
    {
        //$members = $grant->members; // Fetch members using the members() relationship
        $members = $grant->academicians()->wherePivot('role', 'member')->get();
        $milestones = $grant->milestones;
       // $milestones=$grant->milestones()->get();
       // Check if the logged-in user is the leader of the grant
       $isLeader = $grant->leader_id == auth()->user()->id;
    
       // Check if the logged-in user is a member of the grant
       $isMember = $grant->academicians->contains(auth()->user());
        return view('grants.show', compact('grant', 'members'));
    }*/