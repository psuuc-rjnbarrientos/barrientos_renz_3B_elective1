<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    private $users = [];

    public function __construct()
    {
        $this->users = session()->get('users', []);
    }

    private function checkGuest()
    {
        if (session()->has('user')) {
            return redirect()->route('projects.index')->with('info', 'You are already logged in.');
        }
        return null;
    }

    // Show Register Page
    public function showRegister()
    {
        if ($redirect = $this->checkGuest()) return $redirect;
        return view('auth.register');
    }

    // Handle User Registration
    public function register(Request $request)
    {
        // Validate user input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',               // At least 8 characters
                'regex:/[A-Z]/',       // At least 1 uppercase letter
                'regex:/[a-z]/',       // At least 1 lowercase letter
                'regex:/[0-9]/',       // At least 1 number
                'regex:/[@$!%*?&]/',   // At least 1 special character
            ],
        ], [
            'password.regex' => 'Password must be at least 8 characters long and include at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.',
            'password.confirmed' => 'Passwords do not match.',
            'email.unique' => 'This email is already registered.',
        ]);

        // dd("Validation Passed!", $request->all());

        // // Retrieve users from session or initialize an empty array
        // $this->users = session()->get('users', []);

        // // Generate new user ID based on count
        // $user = [
        //     'id' => count($this->users) + 1,
        //     'name' => $request->input('name'),
        //     'email' => $request->input('email'),
        //     'password' => bcrypt($request->input('password')), // Encrypt password
        // ];

        // // Add user to users array
        // $this->users[] = $user;
        // session(['users' => $this->users]); // Store updated user list in session

        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);



        return redirect()->route('login.show')->with('success', 'Account created! Please login.');
    }

    // public function register(Request $request)
    // {
    //     $user = [
    //         'id' => count($this->users) + 1,
    //         'name' => $request->input('name'),
    //         'email' => $request->input('email'),
    //         'password' => bcrypt($request->input('password'))
    //     ];

    //     $this->users[] = $user;
    //     session(['users' => $this->users]);

    //     return redirect()->route('login.show')->with('success', 'Account created! Please login.');
    // }

    // Show Login Page
    public function showLogin()
    {
        if ($redirect = $this->checkGuest()) return $redirect;
        return view('auth.login');
    }

    // Handle User Login
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Find the user in the database
        $user = DB::table('users')->where('email', $email)->first();

        // Check if user exists and password matches
        if ($user && password_verify($password, $user->password)) {
            // Store the full user object in the session
            session(['user' => $user]);

            return redirect()->route('projects.index')->with('success', 'Login successful!');
        }

        return redirect()->route('login.show')->with('error', 'Invalid email or password.');
    }



    // Logout User
    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login.show')->with('success', 'Logged out successfully.');
    }
}
