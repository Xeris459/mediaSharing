<?php

namespace App\Database\Seeds;

use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Database\Seeder;

class Auth extends Seeder
{
    public function run()
    {
        $users = auth()->getProvider();

        // default admin
        $user = new User([
            'username' => 'admin test',
            'email'    => 'admin@gmail.com',
            'password' => 'admin123',
        ]);
        $users->save($user);

        $user = $users->findById($users->getInsertID());

        $users->addToDefaultGroup($user);
    }
}
