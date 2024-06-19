<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    // Method to handle login
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return redirect()->intended($this->redirectPath());
        }

        return back()->withErrors([
            'email' => __('auth.failed'),
        ]);
    }

    protected function redirectPath()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {
            return route('admin.home');
        } else {
            return route('dashboard');
        }
    }
}
