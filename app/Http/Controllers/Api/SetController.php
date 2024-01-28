<?php

namespace App\Http\Controllers\Api;

use App\Models\Set;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SetController extends Controller
{
    public function index()
    {
        // Retrieve all sets for the logged-in user
        $sets = auth()->user()->sets;

        return response()->json(['sets' => $sets], 200);
    }

    public function store(Request $request)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Retrieve the authenticated user
        $user = auth()->user();

        // Now, you can create a set associated with the user
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'required',
            'difficulty_level' => 'required|in:easy,medium,hard',
        ]);

        $set = $user->sets()->create($validatedData);

        return response()->json(['set' => $set], 201);
    }


    public function show(Set $set)
    {
        // Load the flashcards for the set
        $set->load('flashcards');

        return response()->json(['set' => $set], 200);
    }

    public function update(Request $request, Set $set)
    {
        $validatedData = $request->validate([
            'title' => 'max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'nullable',
            'difficulty_level' => 'nullable|in:easy,medium,hard',
            // Add more validation rules as needed
        ]);

        // Update the set details
        $set->update($validatedData);

        return response()->json(['set' => $set], 200);
    }

    public function destroy(Set $set)
    {
        // Delete the set and its flashcards
        $set->delete();

        return response()->json(['message' => 'Set deleted successfully'], 200);
    }
}
