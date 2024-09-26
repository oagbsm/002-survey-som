<?php

namespace App\Http\Controllers;
use App\Models\Survey; // Import the Survey model
use App\Models\SurveyResponse;

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

 public function analytics()
    {
    // Retrieve all survey responses
    $responses = SurveyResponse::all(); // Assuming you have a SurveyResponse model

    // Pass the responses to the view
    return view('business.analytics', [
        'responses' => $responses,
    ]);
    }
    public function dashboard()
    {
        // Retrieve all surveys from the database
        $surveys = Survey::all(); // Get all survey records

        // Pass the surveys to the view
        return view('user.dashboard', compact('surveys'));
    }

    public function submitAnswers(Request $request)
    {
        // Get the survey ID from the request
        $surveyId = $request->input('survey_id');
    
        // Get the answers array from the request
        $answers = $request->input('answers'); // This should be an array where the key is question index
    
        // Prepare an array to store the questions and answers
        $formattedAnswers = [];
    
        foreach ($answers as $index => $answer) {
            // Get the corresponding question text (this assumes you have access to the questions)
            $questionText = ""; // Replace this with your logic to get the question text based on the index
    
            // If the answer is an array (e.g., checkbox answers), convert it to a string
            if (is_array($answer)) {
                $answer = implode(',', $answer); // Join checkbox answers with commas
            }
    
            // Store the question index, question text, and answer in the formatted answers array
            $formattedAnswers[] = [
                'question_index' => $index,
                'answer' => $answer,
            ];
        }
    
        // Convert the formatted answers array to JSON
        $formattedAnswersJson = json_encode($formattedAnswers);
    
        // Save the formatted answers to the survey_responses table
        $response = new SurveyResponse();
        $response->survey_id = $surveyId;
        $response->formatted_answers = $formattedAnswersJson; // Store JSON
        $response->save();
    
        // For debugging, you can use dd to see the formatted answers
        dd([
            'survey_id' => $surveyId,
            'formatted_answers' => $formattedAnswersJson
        ]);
    
        // Redirect or return a response
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
        $cleanedOptions = explode(',', $survey->options); // Split the options into an array

        // Pass the survey data to the view
        return view('user.survey_detail', [
            'survey' => $survey,
            'questions' => $questions, // Pass questions to the view
            'cleanedOptions' => $cleanedOptions, // Pass all options to the view
        ]);
    }

}

