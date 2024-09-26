<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Survey</title>
    <script src="https://cdn.tailwindcss.com"></script>


</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Create a New Survey</h1>
        <form action="{{ route('survey.store') }}" method="POST">
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>
            <div>
            <div id="question-container" class="space-y-4">
                <div class="question flex items-center space-x-2">
                    <label for="questions[]" class="flex-shrink-0">Question:</label>
                    <input type="text" name="questions[]" required class="border border-gray-300 p-2 rounded w-full" placeholder="Enter your question">
                </div>
            </div>
            <button type="button" onclick="addQuestion()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Add Another Question</button>

                <button type="submit">Submit</button>
            </div>
        </form>
        <script>
            function addQuestion() {
                const container = document.getElementById('question-container');
                const newQuestion = document.createElement('div');
                newQuestion.classList.add('question', 'flex', 'items-center', 'space-x-2');
                newQuestion.innerHTML = `
                    <label for="questions[]" class="flex-shrink-0">Question:</label>
                    <input type="text" name="questions[]" required class="border border-gray-300 p-2 rounded w-full" placeholder="Enter your question">
                `;
                container.appendChild(newQuestion);
            }
        </script>
</body>
</html>