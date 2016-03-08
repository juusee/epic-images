<?php

namespace App\Repositories;

use App\Image;
use App\Comment;

class CommentRepository {
    public function getImageComments(Image $image) {
        return Comment::where('image_id', $image->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}