<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the dashboard */
        body {
            background-color: #f3f4f6;
        }
        .survey-card {
            background: white;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.2s ease;
        }
        .survey-card:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Available Surveys</h1>
        
        @if ($surveys->isEmpty())
            <p>No surveys available at the moment.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($surveys as $survey)
                    <div class="survey-card">
                        <h2 class="text-xl font-semibold">{{ $survey->survey_name }}</h2>
                        <p>{{ Str::limit($survey->description, 100) }}</p>
                        <!-- Link to survey detail page -->
                        <a href="{{ route('survey.show', $survey->id) }}" class="mt-2 inline-block bg-blue-500 text-white py-2 px-4 rounded">Take Survey</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
