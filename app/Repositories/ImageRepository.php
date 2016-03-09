<?php

namespace App\Repositories;

use App\User;
use App\Image;

class ImageRepository {

    public function getImage($id) {
        return Image::where('id', $id)->first();
    }

    public function getImages($amount) {
        return Image::take($amount)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getUserImages($user_id) {
        return Image::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function destroy($id) {
        Image::destroy($id);
    }
}