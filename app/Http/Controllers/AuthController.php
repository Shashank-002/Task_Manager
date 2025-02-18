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
        // Define custom error messages
        $messages = [
            'email.required' => 'Email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already taken, please choose another.',

            'password.required' => 'Password field is required.',
            'password.min' => 'Password must have at least 6 characters.',
        ];

        // Validate with custom messages
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
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
        Session::forget('user');
        return redirect('/login');
    }
}
