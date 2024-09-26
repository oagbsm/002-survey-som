<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $survey->survey_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the survey detail */
        body {
            background-color: #f3f4f6;
        }
        .survey-form {
            background: white;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">{{ $survey->survey_name }}</h1>

        <form action="{{ route('survey.submit', $survey->id) }}" method="POST">
            @csrf
            <div class="survey-form">
                @foreach (json_decode($survey->questions) as $index => $question)
                    <div class="mb-4">
                        <label class="block text-lg">{{ $question }}</label>
                        @foreach (json_decode($survey->options) as $option)
                            <div>
                                <input type="radio" name="responses[{{ $survey->id }}][{{ $index }}]" value="{{ $option }}" id="option_{{ $survey->id }}_{{ $index }}_{{ $loop->index }}">
                                <label for="option_{{ $survey->id }}_{{ $index }}_{{ $loop->index }}">{{ $option }}</label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Submit Answers</button>
            </div>
        </form>
    </div>
</body>
</html>
