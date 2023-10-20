<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Images extends Migration
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
            'category_id' => [
                'type'       => 'INT',
                'unsigned'       => true,
                'null' => true,
            ],
            'description' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'image' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'file_name' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'file_size' => [
                'type' => 'float',
                'null' => true,
            ],
            'deleteRequest' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0,
                'null' => true,
                'comment' => '0 = not requested, 1 = requested, 2 = accepted, 3 = rejected',
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
        $this->forge->addKey('category_id');
        $this->forge->createTable('images');
    }

    public function down()
    {
        $this->forge->dropTable('images');
    }
}
