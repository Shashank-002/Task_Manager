<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow-md mt-12">
        <h2 class="text-2xl font-semibold mb-6">Edit Task</h2>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <!-- Task input with error styling -->
            <div class="mb-4">
                <input type="text" name="task" value="{{ old('task', $task->task) }}" class="w-full p-2 border rounded @error('task') border-red-500 @enderror" required>

                <!-- Error message for task -->
                @error('task')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded cursor-pointer">Update Task</button>
        </form>
    </div>
</body>

</html>
