<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SharingImages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sharing_link_id' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'image_id' => [
                'type' => 'int',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('sharing_images');
    }

    public function down()
    {
        //
    }
}
