<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\VerificationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    private function isAdmin()
    {
        return Auth::check() && Auth::user()->role == 'admin';
    }
    /**
     * Display the login form.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Display the registration form.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle the login process.
     */
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($validatedData)) {
            $user = Auth::user();
            if ($user->email_verified_at) {
                if ($user->role == 'admin') {
                    return redirect('/dashboard')->with('success', 'You have Successfully logged in as admin');
                } else {
                    return redirect('/')->with('success', 'You have Successfully logged in as user');
                }
            } else {
                Auth::logout();
                return redirect('/login')->with('warning', 'Please verify your email before logging in.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    /**
     * Process the login request.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($validatedData)) {
            $user = Auth::user();
            if ($user->email_verified_at) {
                if ($user->role == 'admin') {
                    return redirect('/dashboard')->with('success', 'You have Successfully logged in as admin');
                } else {
                    return redirect('/')->with('success', 'You have Successfully logged in as user');
                }
            } else {
                Auth::logout();
                return redirect('/login')->with('error', 'Please verify your email before logging in.');
            }
        } else {
            return redirect('/login')->with('error', 'Invalid credentials');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Handle the registration process.
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'] ?? 'user',
            'verification_code' =>  hash('SHA1', time())
        ]);

        if ($user) {
            Mail::to($user->email)->send(new VerificationEmail($user));

            return redirect('/login')->with('success', 'Registration successful. Please check your email for verification.');
        } else {
            return redirect('/register')->with('error', 'Registration failed. Please try again.');
        }
    }

    /**
     * Logout the authenticated user.
     */
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have successfully logged out.');
    }

    /**
     * Verify the user's email.
     */
    public function verifyEmail(string $token)
    {
        $user = User::where('verification_code', $token)->first();

        if ($user) {
            $user->update([
                'verification_code' => '',
                'email_verified_at' => now(),
            ]);

            Auth::login($user);
            return redirect('/dashboard')->with('success', 'Email verification successful. You are now logged in.');
        }

        return redirect('/login')->with('error', 'Invalid verification token.');
    }
}
