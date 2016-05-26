<?php

namespace App\Rbac;

use DCN\RBAC\Models\Role;
use DCN\RBAC\Models\Permission;

class Rbac {

    static function initRolesAndPermissions() {
        $adminRole = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);

        $userRole = Role::create([
            'name' => 'User',
            'slug' => 'user',
            'parent_id' => $adminRole->id,
        ]);

        $deleteUsersPermission = Permission::create([
            'name' => 'Delete users',
            'slug' => 'delete.users',
            'model' => 'App\User',
        ]);

        $editUsersPermission = Permission::create([
            'name' => 'Edit users',
            'slug' => 'edit.users',
            'model' => 'App\User',
        ]);

        $deleteImagesPermission = Permission::create([
            'name' => 'Delete.images',
            'slug' => 'delete.images',
            'model' => 'App\Image',
        ]);

        $editImagesPermission = Permission::create([
            'name' => 'Edit.images',
            'slug' => 'edit.images',
            'model' => 'App\Image',
        ]);

        $adminRole->attachPermission($deleteUsersPermission);
        $adminRole->attachPermission($editUsersPermission);
        $adminRole->attachPermission($deleteImagesPermission);
        $adminRole->attachPermission($editImagesPermission);
    }

    static function getUserRole() {
        return Role::where('name', 'User')->get();
    }

    static function getAdminRole() {
        return Role::where('name', 'Admin')->get();
    }
}