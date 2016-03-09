<?php
/**
 * Created by PhpStorm.
 * User: juusee
 * Date: 08/03/16
 * Time: 18:59
 */

namespace App\Domain\Data\UIElements;

use App\Image;

class UIImage {

    public $id;
    public $user_id;
    public $extension;
    public $description;
    public $created_at;
    public $updated_at;

    public function __construct(Image $image) {
        $this->id           = $image->id;
        $this->user_id      = $image->user_id;
        $this->extension    = $image->extension;
        $this->description  = $image->description;
        $this->created_at   = $image->created_at;
        $this->updated_at   = $image->updated_at;
    }
}