<?php
/**
 * Created by PhpStorm.
 * User: juusee
 * Date: 08/03/16
 * Time: 20:37
 */

namespace App\Domain\Data\UIElements;


use Illuminate\Foundation\Auth\User;

class UIUser {

    public $id;
    public $username;
    public $email;
    public $created_at;
    public $updated_at;

    public function __construct(User $user) {
        $this->id = $user->id;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->created_at = $user->created_at;
        $this->updated_at = $user->updated_at;
    }

}