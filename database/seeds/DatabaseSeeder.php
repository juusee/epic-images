<?php

use App\Image;
use App\User;
use Illuminate\Database\Seeder;
use App\Rbac\Rbac;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Rbac::initRolesAndPermissions();

        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        $juusee = User::create([
            'username' => 'juusee',
            'email' => 'juusee@gmail.com',
            'password' => bcrypt('juusee123'),
        ]);

        $janne = User::create([
            'username' => 'janne',
            'email' => 'janne@gmail.com',
            'password' => bcrypt('janne123'),
        ]);

        $admin->attachRole(Rbac::getAdminRole());
        $juusee->attachRole(Rbac::getUserRole());
        $janne->attachRole(Rbac::getUserRole());

        $juusee->images()->create([
            'extension' => 'jpeg',
            'description' => 'Joku krikettikuva?',
        ]);

        $juusee->images()->create([
            'extension' => 'jpeg',
            'description' => 'Hieno krossikuva!',
        ]);

        $janne->images()->create([
            'extension' => 'jpeg',
            'description' => 'Wazaaaaaaa!',
        ]);
    }
}
