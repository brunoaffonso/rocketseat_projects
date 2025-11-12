<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        if ($request->tryToRegister()) {
            return to_route('dashboard');
        }

        return back()->with('message', 'Registration failed. Please try again.');
    }
}