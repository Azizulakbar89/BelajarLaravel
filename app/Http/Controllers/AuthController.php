<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $user = Auth::user();
        return view('login');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // memanggil auth attempt di kernel
        if (Auth::attempt($credentials)) {
            // jika sama maka session dibikin dan direct
            $request->session()->regenerate();

            return redirect()->intended('blog');
        }

        return back()->withErrors('Login Invalid.')->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
