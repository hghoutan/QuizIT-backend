<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flashcard;
use App\Models\Set;

class FlashcardController extends Controller
{
    public function index(Set $set)
    {
        // Retrieve all flashcards for the specified set
        $flashcards = $set->flashcards;

        return response()->json(['flashcards' => $flashcards], 200);
    }

    public function store(Request $request, Set $set)
    {
        $validatedData = $request->validate([
            'term' => 'required|max:255',
            'definition' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Add more validation rules as needed
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('flashcard_images');
            $validatedData['image'] = $imagePath;
        }

        // Create a new flashcard associated with the specified set
        $flashcard = $set->flashcards()->create($validatedData);

        return response()->json(['flashcard' => $flashcard], 201);
    }

    public function show(Flashcard $flashcard)
    {
        // Check if the authenticated user is the owner of the flashcard
        if ($flashcard->set->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['flashcard' => $flashcard], 200);
    }


    public function update(Request $request, Flashcard $flashcard)
    {
        if ($flashcard->set->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validatedData = $request->validate([
            'term' => 'max:255',
            'definition' => 'string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Add more validation rules as needed
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('flashcard_images');
            $validatedData['image'] = $imagePath;
        }

        // Update the flashcard details
        $flashcard->update($validatedData);

        return response()->json(['flashcard' => $flashcard], 200);
    }

    public function destroy(Flashcard $flashcard)
    {
        if ($flashcard->set->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        // Delete the flashcard
        $flashcard->delete();

        return response()->json(['message' => 'Flashcard deleted successfully'], 200);
    }
}
