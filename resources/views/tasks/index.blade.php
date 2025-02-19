<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        /* Ensure the content does not hide behind the navbar */
        body {
            padding-top: 80px;
            /* Adjust according to the navbar height */
        }

        /* Custom Hover effects */
        .btn-hover:hover {
            opacity: 0.8;
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-black p-5 fixed w-full top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="#" class="text-white font-semibold text-xl md:text-2xl">Task Management</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white py-2 px-6 rounded-full shadow-md focus:outline-none cursor-pointer">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-3xl mx-4 lg:mx-auto p-8 bg-white rounded-xl shadow-lg mt-24">
        <h2 class="text-3xl font-semibold mb-6 text-center text-gray-800">Your Tasks</h2>

        <!-- Task Form -->
        <form action="{{ route('tasks.add') }}" method="POST" class="mb-8">
            @csrf
            <div class="mb-4">
                <input type="text" name="task" placeholder="Enter your task" class="w-full p-4 border rounded-lg shadow-md text-lg focus:ring-2 focus:ring-blue-300 transition-all duration-300 ease-in-out">
                @error('task')
                <p class="text-red-500 text-sm my-2">{{ $message }}</p>
                @enderror
            </div>

            @if(count($tasks) == 0)
            <p class="text-center text-gray-500 py-4">No tasks added yet.</p>
            @endif

            <button type="submit" class="w-full py-3 bg-blue-500 text-white rounded-lg shadow-lg focus:outline-none cursor-pointer">Add Task</button>
        </form>

        <!-- Task List -->
        <ul class="space-y-4 max-h-60 overflow-y-auto">
            @foreach($tasks as $task)
            <li class="flex justify-between items-center p-4 bg-gray-100 rounded-lg shadow-md hover:bg-gray-200 transition-all duration-300 ease-in-out mb-2">
                <span class="text-lg text-gray-700">{{ $task->task }}</span>
                <div class="flex space-x-3">
                    <!-- Edit Button -->
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn-hover p-3 bg-yellow-400 text-white rounded-full shadow-md hover:bg-yellow-500 transition-all duration-300 ease-in-out">Edit</a>

                    <!-- Delete Form -->
                    <form action="{{ route('tasks.delete', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-hover p-3 bg-red-500 text-white rounded-full shadow-md hover:bg-red-600 transition-all duration-300 ease-in-out">Delete</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>

    </div>
</body>

</html>