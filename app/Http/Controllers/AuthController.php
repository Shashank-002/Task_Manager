<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $messages = [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already taken, please choose another.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must have at least 6 characters.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one special character.',
            'password_confirmation.required' => 'Confirm password is required.',
            'password_confirmation.same' => 'Password do not match'
        ];

        // Validate with custom messages
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
            ],
            'password_confirmation' => 'required'
        ], $messages);

        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()
                ->withErrors(['password_confirmation' => 'Password do not match'])
                ->withInput();
        }

        // Store user data in the database
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the user in
        Auth::login($user);

        return redirect('/login');
    }

    public function login(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Log the user in
            Auth::login($user);

            return redirect('/tasks');
        }

        return back()->withErrors([
            'credentials' => 'Invalid email or password. Please try again.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
