<?php
/**
 * Created by PhpStorm.
 * User: juusee
 * Date: 08/03/16
 * Time: 20:40
 */

namespace App\Domain\Services;


use App\Domain\Data\UIElements\UIUser;
use App\Repositories\UserRepository;
use App\User;

/*
 * Methods return UI-objects instead of Eloquent-objects, so
 * transaction boundary is set here
 */
class UserService {

    protected $users;
    protected $imageService;
    protected $commentService;

    public function __construct(UserRepository $users, ImageService $imageService, CommentService $commentService) {
        $this->users = $users;
        $this->imageService = $imageService;
        $this->commentService = $commentService;
    }

    public function getUserByName($username) {
        $user = $this->users->getUserByName($username);
        if ($user == null)
            return null;
        return new UIUser($user);
    }

    public function getUserById($id) {
        $user = $this->users->getUserById($id);
        if ($user == null)
            return null;
        return new UIUser($user);
    }

    public function removeUser($user) {
        $images = $this->imageService->getUserImages($user->id);
        $comments = $this->commentService->getUserComments($user->user_id);

        foreach ($images as $image) {
            $this->imageService->removeImage($image);
        }

        foreach ($comments as $comment) {
            $this->commentService->removeComment($comment);
        }

        $this->users->destroy($user->id);
    }
}