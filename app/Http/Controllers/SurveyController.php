<?php

namespace App\Http\Controllers;
use App\Models\Survey; // Import the Survey model

use Illuminate\Http\Request;

class SurveyController extends Controller
{    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'survey_name' => 'required|string|max:255', // Validate the survey name
            'questions.*' => 'required|string|max:255', // Validate each question
            'question_type.*' => 'required|string|in:text,rating,dropdown,checkbox', // Validate question types
            'options.*' => 'nullable|string', // Validate options, if provided
        ]);

        // Create a new survey entry in the database
        $survey = Survey::create([
            'survey_name' => $request->input('survey_name'),
            'questions' => json_encode($request->input('questions')),
            'question_type' => json_encode($request->input('question_type')),
            'options' => json_encode($request->input('options')),
        ]);

        // Display a success message or redirect as needed
        return redirect()->back()->with('success', 'Survey created successfully!');
    }

    public function dashboard()
    {
        // Retrieve all surveys from the database
        $surveys = Survey::all(); // Get all survey records

        // Pass the surveys to the view
        return view('user.dashboard', compact('surveys'));
    }
    public function submitAnswers(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'responses.' . $id . '.*' => 'required|string', // Ensure all responses are filled out
        ]);

        // Get the responses
        $responses = $request->input('responses')[$id];

        // Instead of saving, echo the responses
        $responseString = "Responses for Survey ID {$id}:<br>";
        
        foreach ($responses as $questionIndex => $response) {
            $responseString .= "Question {$questionIndex}: {$response}<br>";
        }

        return response()->json([
            'success' => true,
            'message' => $responseString,
        ]);
    }

    public function show($id)
    {
        // Retrieve the survey by ID, or fail if not found
        $survey = Survey::findOrFail($id);

        // Pass the survey data to the view
        return view('user.survey_detail', [
            'survey' => $survey,
        ]);
    }

}

