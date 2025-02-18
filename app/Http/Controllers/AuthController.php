<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            // 'password_confirmation.confirmed' => 'Confirm password does not match.'
        ];

        // Validate with custom messages
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
            ],
            'password_confirmation' => 'required' 
        ], $messages);

        // Store user data in session
        Session::put('user', [
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/login');
    }


    public function login(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Session::get('user');

        if ($user && $user['email'] == $request->email && password_verify($request->password, $user['password'])) {
            return redirect('/tasks');
        }

        return back()->withErrors([
            'credentials' => 'Invalid email or password. Please try again.',
        ]);
    }

    public function logout()
    {
        // Session::forget('user');
        return redirect('/login');
    }
}
