<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // Metode login
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return redirect()->route('dashboard');
    }

    return back()->withErrors([
        'email' => 'These credentials do not match our records.',
    ]);
}

    // Metode untuk menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Metode untuk logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

