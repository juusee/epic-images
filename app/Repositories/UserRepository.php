<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    public function getUserByName($username) {
        return User::where('username', $username)->first();
    }

    public function getUserById($id) {
        return User::where('id', $id)->first();
    }

    public function destroy($id) {
        User::destroy($id);
    }
}