<?php

namespace App\Http\Controllers;

use App\Models\User;

class BioLinkController extends Controller
{
    public function __invoke(User $user)
    {
        return view('bio-links', compact('user'));
    }
}
