<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        // Retrieve quizzes associated with the authenticated user
        $user = Auth::user();
        $quizzes = $user->quizzes;

        return response()->json($quizzes);
    }

    public function show($id)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Find the quiz by ID and user association
        $quiz = $user->quizzes()->find($id);

        // Check if the quiz was not found or does not belong to the authenticated user
        if (!$quiz) {
            return response()->json(['error' => 'Quiz not found or unauthorized access'], 404);
        }

        return response()->json($quiz);
    }


    // Store a new quiz associated with the authenticated user
    public function store(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'description' => 'required',
                'answers.answer_a' => 'required',
                'answers.answer_b' => 'required',
                'answers.answer_c' => 'required',
                'answers.answer_d' => 'required',
                'correct_answer' => 'required|in:answer_a,answer_b,answer_c,answer_d',
                'explanation' => 'required',
                'tip' => 'required',
                'tags' => 'required|array',
                'tags.*.name' => 'required|string',
                'category' => 'required|string',
                'difficulty' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            // Get the authenticated user
            $user = Auth::user();

            // Create a new quiz associated with the authenticated user
            $quiz = $user->quizzes()->create($request->all());


            return response()->json([
                'message' => 'Quiz created successfully',
                'user_id' => $user->id,
            ]);
        } else {
            
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'description' => 'required',
                'answers.answer_a' => 'required',
                'answers.answer_b' => 'required',
                'answers.answer_c' => 'required',
                'answers.answer_d' => 'required',
                'correct_answer' => 'required|in:answer_a,answer_b,answer_c,answer_d',
                'explanation' => 'required',
                'tip' => 'required',
                'tags' => 'required|array',
                'tags.*.name' => 'required|string',
                'category' => 'required|string',
                'difficulty' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            // Find the quiz by ID and user association
            $user = Auth::user();
            $quiz = $user->quizzes()->findOrFail($id);

            // Update the quiz with the new data
            $quiz->update($request->all());

            return response()->json([
                'message' => 'Quiz updated successfully',
                'quiz_id' => $quiz->id,
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function destroy($id)
    {
        // Ensure that the user is authenticated
        if (Auth::check()) {
            // Find the quiz by ID and user association
            $user = Auth::user();
            $quiz = $user->quizzes()->findOrFail($id);

            // Delete the quiz
            $quiz->delete();

            return response()->json(['message' => 'Quiz deleted successfully']);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
