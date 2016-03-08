<?php

namespace App\Policies;

use App\User;
use App\Image;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, Image $image) {
        return $user->id === $image->user_id;
    }
}
