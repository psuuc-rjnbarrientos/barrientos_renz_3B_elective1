<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Auth\SessionGuard;

class LoginController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        // Validate input data
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // retrieve user by email
        $user = DB::table('users')->where('email', $request->email)->first();
        
        // Check if user exists and password matches
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::loginUsingId($user->id);// Login user using user ID
            return view('dashboard');
            // return redirect()->route('dashboard'); // Redirect to dashboard or home
        }

        return back()->withErrors(['email' => 'Invalid Credentials']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.show');
    }
}
