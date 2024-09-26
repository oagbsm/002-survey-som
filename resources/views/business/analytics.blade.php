<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Responses</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">All Survey Responses</h1>

        @if ($responses->isEmpty())
            <p class="text-gray-600">No survey responses available.</p>
        @else
            <div class="grid grid-cols-1 gap-4">
                @foreach ($responses as $response)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold">Response ID: {{ $response->id }}</h3>
                        <p><strong>Survey ID:</strong> {{ $response->survey_id }}</p>
                        <pre class="mt-2">{{ json_encode(json_decode($response->formatted_answers), JSON_PRETTY_PRINT) }}</pre> <!-- Assuming 'formatted_answers' is a JSON string -->
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
