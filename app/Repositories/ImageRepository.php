<?php

namespace App\Repositories;

use App\User;
use App\Image;

class ImageRepository {
    /*
     * Get all of the tasks for a given user
     */
    public function getUserImages(User $user) {
        return Image::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getImages() {
        return Image::take(20)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getImage($id) {
        return Image::where('id', $id)->first();
    }
}