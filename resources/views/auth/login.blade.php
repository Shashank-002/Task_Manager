<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-md mx-auto p-6 bg-white rounded-xl shadow-md mt-12">
        <h2 class="text-2xl font-semibold mb-6 text-center">Login</h2>

        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email input -->
            <input type="email" name="email" placeholder="Email" class="w-full p-2 mb-4 border rounded @error('email') border-red-500 @enderror" value="{{ old('email') }}">

            <!-- Password input -->
            <input type="password" name="password" placeholder="Password" class="w-full p-2 mb-4 border rounded @error('password') border-red-500 @enderror" value="{{ old('password') }}">

            <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded cursor-pointer">Login</button>
        </form>

        <p class="mt-4 text-center">
            Don't have an account? <a href="{{ route('register') }}" class="text-blue-500">Register</a>
        </p>
    </div>
</body>

</html>