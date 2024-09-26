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
        $surveyId = $request->input('survey_id');
        $answers = $request->input('answers');
    
        // Create an array to hold the answers with their indices
        $formattedAnswers = [];
    
        foreach ($answers as $index => $answer) {
            // If the answer is an array (e.g., checkbox answers), convert it to a string
            if (is_array($answer)) {
                $answer = implode(',', $answer);
            }
    
            // Add the question index and answer to the formatted array
            $formattedAnswers[$index] = $answer;
        }
    
        // Update the survey record with the formatted answers
        $survey = Survey::find($surveyId);
        $survey->answers = json_encode($formattedAnswers); // Store the answers as JSON
        $survey->save();
    
        // For debugging, you can use dd to see the formatted answers
        dd($formattedAnswers);
    
        return redirect()->route('surveys.index')->with('success', 'Responses submitted successfully!');
    }


        // Get the responses
        // $responses = $request->input('responses')[$id];

        // // Instead of saving, echo the responses
        // $responseString = "Responses for Survey ID {$id}:<br>";
        
        // foreach ($responses as $questionIndex => $response) {
        //     $responseString .= "Question {$questionIndex}: {$response}<br>";
        // }

        // return response()->json([
        //     'success' => true,
        //     'message' => $responseString,
        // ]);
    

    public function show($id)
    {
        // Retrieve the survey by ID or fail if not found
        $survey = Survey::findOrFail($id); 
        
        // Assuming you store questions and options as JSON
        $questions = json_decode($survey->questions); // Decode questions from JSON
        $allOptions = explode(',', $survey->options); // Split the options into an array

        // Pass the survey data to the view
        return view('user.survey_detail', [
            'survey' => $survey,
            'questions' => $questions, // Pass questions to the view
            'allOptions' => $allOptions, // Pass all options to the view
        ]);
    }

}

