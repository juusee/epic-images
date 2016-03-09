<?php
/**
 * Created by PhpStorm.
 * User: juusee
 * Date: 08/03/16
 * Time: 18:52
 */

namespace App\Domain\Services;


use App\Domain\Data\UIElements\UIImage;
use App\Repositories\ImageRepository;
use Illuminate\Support\Facades\Config;

/*
 * Methods return UI-objects instead of Eloquent-objects, so
 * transaction boundary is set here
 */
class ImageService {

    protected $images;
    protected $commentService;

    public function __construct(ImageRepository $images, CommentService $commentService) {
        $this->images = $images;
        $this->commentService = $commentService;
    }

    public function getImage($id) {
        $image = $this->images->getImage($id);
        if ($image == null)
            return null;
        return new UIImage($image);
    }

    public function getImages($page) {
        $images = $this->images->getImages(Config::get('myConfig.imagesPerPage'));
        $ui_images = array();

        foreach ($images as $image) {
            array_push($ui_images, new UIImage($image));
        }

        return $ui_images;
    }

    public function getUserImages($user_id) {
        $images = $this->images->getUserImages($user_id);
        $ui_images = array();

        foreach ($images as $image) {
            array_push($ui_images, new UIImage($image));
        }

        return $ui_images;
    }

    public function removeImage($image) {
        $comments = $this->commentService->getImageComments($image->id);

        foreach ($comments as $comment) {
            $this->commentService->removeComment($comment);
        }

        unlink('images/' . $image->id . '.' . $image->extension);
        // TODO error handling
        $this->images->destroy($image->id);
    }
}