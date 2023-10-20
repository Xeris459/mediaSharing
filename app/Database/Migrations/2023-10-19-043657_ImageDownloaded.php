<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ImageDownloaded extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'unsigned'       => true,
            ],
            'image_id' => [
                'type'       => 'INT',
                'unsigned'       => true,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('user_id');
        $this->forge->addKey('image_id');
        $this->forge->createTable('image_downloaded');
    }

    public function down()
    {
        $this->forge->createTable('image_downloaded');
    }
}
