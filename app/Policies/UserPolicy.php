<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, User $userToRemove) {
        return $user->id === $userToRemove->id;
    }
}
