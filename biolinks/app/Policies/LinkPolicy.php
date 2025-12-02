<?php

namespace App\Policies;

use App\Models\Link;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LinkPolicy
{
    public function edit(User $user, Link $link): Response
    {
        return $link->user->is($user)
            ? Response::allow()
            : Response::deny('Esse link não é seu!');
    }

    function delete(User $user, Link $link): Response
    {
        return $link->user->is($user)
            ? Response::allow()
            : Response::deny('Esse link não é seu!');
    }
}
