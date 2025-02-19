<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-md mx-auto p-6 bg-white rounded-xl shadow-md mt-12">
        <h2 class="text-2xl font-semibold mb-6 text-center">Register Page</h2>

        <form action="{{ route('register') }}" method="POST" novalidate>
            @csrf

            <!-- Email input -->
            <div class="mb-4">
                <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password input -->
            <div class="mb-4">
                <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded @error('password') border-red-500 @enderror" value="{{ old('password') }}">
                @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password input -->
            <div class="mb-4">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full p-2 border rounded @error('password_confirmation') border-red-500 @enderror" value="{{ old('password_confirmation') }}">
                @error('password_confirmation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded cursor-pointer">Register</button>
            <p class="mt-4 text-center">
                Already registered? <a href="{{ route('login') }}" class="text-blue-500">Login</a>
            </p>
        </form>
    </div>
</body>

</html>