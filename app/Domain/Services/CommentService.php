<?php
/**
 * Created by PhpStorm.
 * User: juusee
 * Date: 08/03/16
 * Time: 21:01
 */

namespace App\Domain\Services;


use App\Domain\Data\UIElements\UIComment;
use App\Repositories\CommentRepository;

class CommentService {

    protected $comments;

    public function __construct(CommentRepository $comments) {
        $this->comments = $comments;
    }

    public function getImageComments($image_id) {
        $comments = $this->comments->getImageComments($image_id);
        $ui_comments = array();

        foreach ($comments as $comment) {
            array_push($ui_comments, new UIComment($comment));
        }

        return $ui_comments;
    }

    public function getUserComments($user_id) {
        $comments = $this->comments->getUserComments($user_id);
        $ui_comments = array();

        foreach ($comments as $comment) {
            array_push($ui_comments, new UIComment($comment));
        }

        return $ui_comments;
    }

    public function removeComment($comment) {
        $this->comments->destroy($comment->id);
    }

}