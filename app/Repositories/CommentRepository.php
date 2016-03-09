<?php

namespace App\Repositories;

use App\Image;
use App\Comment;

class CommentRepository {
    public function getImageComments($image_id) {
        return Comment::where('image_id', $image_id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getUserComments($user_id) {
        return Comment::where('user_id', $user_id)
            ->get();
    }

    public function destroy($id) {
        Comment::destroy($id);
    }
}