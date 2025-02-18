<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow-md mt-12">
        <h2 class="text-2xl font-semibold mb-6">Your Tasks</h2>
        <form action="{{ route('tasks.add') }}" method="POST" class="mb-4">
            @csrf
            <input type="text" name="task" placeholder="Enter your task" class="w-full p-2 border rounded mb-2">
            @error('task')
            <p class="text-red-500 text-sm my-1">{{ $message }}</p>
            @enderror
            <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded cursor-pointer">Add Task</button>
        </form>

        <ul class="space-y-2">
            @foreach($tasks as $index => $task)
            <li class="flex justify-between items-center">
                <span>{{ $task }}</span>
                <div class="flex space-x-2">
                    <a href="{{ route('tasks.edit', $index) }}" class="p-2 bg-yellow-500 text-white rounded cursor-pointer">Edit</a>
                    <form action="{{ route('tasks.delete', $index) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-red-500 text-white rounded cursor-pointer">Delete</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>

        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="w-1/6 p-2 bg-red-500 text-white rounded cursor-pointer">Logout</button>
        </form>
    </div>
</body>

</html>