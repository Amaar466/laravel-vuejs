<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teammember;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        // Fetch all team members from the database
        $teamMembers = Teammember::all();


        // Return as JSON response
        return response()->json($teamMembers, 200);
    }
    public function store(Request $request)
    {

        $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    }

    $team = new Teammember();

    $team->name = $request->input('name');
    if ($imagePath) {
        $team->image = $imagePath;
    }
    $team->position = $request->input('position');
    $team->bio = $request->input('bio');


    $team->save();
    return response()->json(['message' => 'Team Member added successfully'
          ],
          201);
}

public function update(Request $request, $id)
{
    // Find the team member by ID
    $teammember = Teammember::findOrFail($id);

    // Handle image file if provided
    if ($request->hasFile('image')) {
        // Delete the old image (if needed)
        if ($teammember->image && Storage::exists('public/' . $teammember->image)) {
            Storage::delete('public/' . $teammember->image);
        }
        // Store the new image
        $imagePath = $request->file('image')->store('images', 'public');
        $teammember->image = $imagePath;
    }

    // Update the fields directly from the request
    if ($request->has('name')) {
        $teammember->name = $request->input('name');
    }

    if ($request->has('position')) {
        $teammember->position = $request->input('position');
    }

    if ($request->has('bio')) {
        $teammember->bio = $request->input('bio');
    }

    // Save the changes to the database
    $teammember->save();

    return response()->json(['message' => 'Team Member updated successfully', 'data' => $teammember], 200);
}



}
