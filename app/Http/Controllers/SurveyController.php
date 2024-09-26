<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function store(Request $request)
    {
        // // Validate the incoming request data
        // $request->validate([
        //     'name' => 'required|string|max:255',
        // ]);

        // // Get the name from the request
        // $name = $request->input('name');

        // // Echo the name
        // echo "Submitted Name: " . htmlspecialchars($name);
        $inputData = $request->all();

        // Print all input data
        echo "<h3 class='text-xl font-bold'>Submitted Data:</h3><pre class='bg-gray-100 p-4 rounded'>" . htmlspecialchars(print_r($inputData, true)) . "</pre>";
    }
}
