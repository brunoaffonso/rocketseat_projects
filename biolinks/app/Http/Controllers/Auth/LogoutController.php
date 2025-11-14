<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    // Learn note
    public function __invoke()
    {
        auth()->logout();
        session()->invalidate();

        return to_route('login');
    }
}
