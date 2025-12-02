<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view(
            'profile',
            [
                'user' => auth()->user()
            ]
        );
    }

    public function update(ProfileRequest $request)
    {
        /**@var User $user */
        $user = auth()->user();

        $user->fill($request->validated())->save();

        return back()
            ->with(
                'success',
                'Profile atualizado com sucesso.'
            );
    }
}
