{{-- resources/views/user/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">User Dashboard</h1>
        
        @if ($surveys->isEmpty())
            <p>No surveys available.</p>
        @else
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Survey Name</th>
                        <th class="py-2 px-4 border-b">Questions</th>
                        <th class="py-2 px-4 border-b">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surveys as $survey)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $survey->survey_name }}</td>
                            <td class="py-2 px-4 border-b">
                                <ul>
                                    @foreach (json_decode($survey->questions) as $question)
                                        <li>{{ $question }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <ul>
                                    @foreach (json_decode($survey->options) as $option)
                                        <li>{{ $option }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
