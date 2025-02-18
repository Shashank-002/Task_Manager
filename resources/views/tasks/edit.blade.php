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
        <form action="{{ route('tasks.update', $taskIndex) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="task" value="{{ $task }}" class="w-full p-2 border rounded mb-2" required>
            <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded cursor-pointer">Update Task</button>
        </form>
    </div>
</body>

</html>