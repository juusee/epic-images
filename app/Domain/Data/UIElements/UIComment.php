<?php
/**
 * Created by PhpStorm.
 * User: juusee
 * Date: 08/03/16
 * Time: 21:01
 */

namespace App\Domain\Data\UIElements;


use App\Comment;

class UIComment {

    public $id;
    public $user_id;
    public $image_id;
    public $user;
    public $content;
    public $created_at;
    public $updated_at;

    public function __construct(Comment $comment) {
        $this->id = $comment->id;
        $this->user_id = $comment->user_id;
        $this->image_id = $comment->image_id;
        $this->user = $comment->user;
        $this->content = $comment->content;
        $this->created_at = $comment->created_at;
        $this->updated_at = $comment->updated_at;
    }
}