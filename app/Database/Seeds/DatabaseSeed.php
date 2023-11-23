<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeed extends Seeder
{
    public function run()
    {
        $this->call('Auth');
        $this->call('Category');
        $this->call('Images');
    }
}
