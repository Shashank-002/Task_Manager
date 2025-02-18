<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        /* Make sure the content doesn't hide behind the navbar */
        body {
            padding-top: 50px;
            /* Adjust according to the navbar height */
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-300 p-4 fixed w-full top-0 z-50 px-20">
        <div class="max-w-full mx-auto flex justify-between items-center">
            <a href="#" class="text-white font-semibold text-xl">Task Management</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded cursor-pointer">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow-md mt-16">
        <h2 class="text-2xl font-semibold mb-6">Your Tasks</h2>

        <!-- Task Form -->
        <form action="{{ route('tasks.add') }}" method="POST" class="mb-4">
            @csrf
            <input type="text" name="task" placeholder="Enter your task" class="w-full p-2 border rounded mb-2">
            @error('task')
            <p class="text-red-500 text-sm my-1">{{ $message }}</p>
            @enderror

            <!-- Show message if no tasks are available -->
            @if(count($tasks) ==0)
            <p class="text-center text-gray-500 py-4">No tasks added yet.</p>
            @endif

            <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded cursor-pointer">Add Task</button>
        </form>

        <!-- Task List -->
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
    </div>
</body>

</html>